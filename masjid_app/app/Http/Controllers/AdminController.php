<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Tambah ini untuk DB::raw
use App\Models\Registration;
use App\Models\ServiceRequest;
use App\Models\Event;
use App\Models\Donation; // Tambah Model Donation
use App\Notifications\EventReminder;
use Illuminate\Support\Facades\Notification;
use App\Models\DonationProgram;
use Illuminate\Support\Facades\Http;
use InfluxDB\Client as InfluxClient;

class AdminController extends Controller
{
    public function __construct()
    {
        // Middleware is applied in routes/web.php
    }

    public function dashboard()
    {
        if (Auth::guard('committee')->check()) {
            $committee = Auth::guard('committee')->user();
            $events = Event::orderBy('event_date')->get();
            
            // 1. KIRA TOTAL SUMBANGAN (Hanya yang berjaya/success)
            $totalDonations = Donation::where('status', 'success')->sum('amount');

            // 2. KIRA TREND SUMBANGAN (Grouping ikut bulan untuk tahun semasa)
            $monthlyDonations = Donation::select(
                DB::raw('SUM(amount) as total'), 
                DB::raw('MONTH(created_at) as month')
            )
            ->where('status', 'success')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

            // Format data untuk Chart.js (Isi 0 untuk bulan tiada derma)
            $chartData = [];
            for ($i = 1; $i <= 12; $i++) {
                $chartData[] = $monthlyDonations[$i] ?? 0;
            }

            return view('admin.dashboard', compact('events', 'committee', 'totalDonations', 'chartData'));
        }
        return redirect('/committee/login')->with('error', 'Please login as committee member.');
    }

    // --- BAHAGIAN PENGURUSAN DERMA BARU ---

    public function indexDonations()
    {
        // Paparkan derma 'pending' di atas
        $donations = Donation::with('donor')
                    ->orderByRaw("FIELD(status, 'pending', 'success', 'failed')")
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);

        return view('admin.donations.index', compact('donations'));
    }



    public function verifyDonation(Donation $donation)
    {
    // 1. Kemaskini status derma kepada 'success'
    $donation->update(['status' => 'success']);

    // 2. Semak jika jenis derma adalah ID Program (nombor)
    // Jika value="umum", ia bukan nombor, so kod ini akan skip (tak error)
    if (is_numeric($donation->type)) {
        
        // Cari program menggunakan ID (Primary Key)
        $program = DonationProgram::find($donation->type);

        // 3. Jika program wujud, tambah amaun
        if ($program) {
            $program->current_amount = $program->current_amount + $donation->amount;
            $program->save();
        }
    }

    return redirect()->back()->with('success', 'Sumbangan disahkan & jumlah tabung dikemaskini!');
    }
    

    public function rejectDonation(Donation $donation)
    {
        $donation->update(['status' => 'failed']);
        return redirect()->back()->with('success', 'Sumbangan telah ditolak/dibatalkan.');
    }

    // ... (Kekalkan function lain: storeEvent, indexRegistrations, dll seperti asal) ...
    
    public function storeEvent(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'capacity' => 'required|integer|min:1',
        ]);
        Event::create($validated);
        return redirect()->route('admin.events.create')->with('success', 'Event created.');
    }

    public function indexRegistrations()
    {
        $registrations = Registration::with('participant', 'event')->get();
        return view('admin.registrations.index', compact('registrations'));
    }

    public function indexServiceRequest()
    {
        $serviceRequests = ServiceRequest::with('committee', 'event')->get();
        return view('admin.service_requests.index', compact('serviceRequests'));
    }

    public function createServiceRequest()
    {
        $events = Event::orderBy('event_date')->get();
        return view('admin.service_requests.create', compact('events'));
    }

    public function storeServiceRequest(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'description' => 'required|string|max:1000',
        ]);

        ServiceRequest::create([
            'committee_id' => Auth::guard('committee')->id(),
            'event_id' => $request->event_id,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.service_requests.index')->with('success', 'Service request submitted successfully!');
    }

    public function sendNotifications()
    {
        // Get all participants with approved registrations
        $registrations = Registration::where('status', 'approved')
            ->with(['participant', 'event'])
            ->get();
        
        $sentCount = 0;
        
        if ($registrations->isNotEmpty()) {
            foreach ($registrations as $registration) {
                // ... (Logic email sedia ada)
                $participant = $registration->participant;
                $event = $registration->event;
                // Simpan simple logic untuk contoh
                $sentCount++;
            }
        }
        
        return redirect()->back()->with('success', "Notifications process completed.");
    }

    public function approveRegistration(Registration $registration)
    {
        $registration->update(['status' => 'approved']);
        return redirect()->route('admin.registrations.index')->with('success', 'Registration approved successfully!');
    }

    public function rejectRegistration(Registration $registration)
    {
        $registration->update(['status' => 'rejected']);
        return redirect()->route('admin.registrations.index')->with('success', 'Registration rejected successfully!');
    }

    // Senarai Program
    public function indexDonationPrograms()
    {
        $programs = DonationProgram::latest()->get();
        return view('admin.donation_programs.index', compact('programs'));
    }

    // Papar Borang Create
    public function createDonationProgram()
    {
        return view('admin.donation_programs.create');
    }

    // Simpan Program Baru
    public function storeDonationProgram(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'status' => 'required|in:active,completed,inactive',
        ]);

        DonationProgram::create($request->all());

        return redirect()->route('admin.donation_programs.index')
            ->with('success', 'Program sumbangan berjaya dicipta!');
    }

    // Delete Program
    public function destroyDonationProgram(DonationProgram $program)
    {
        $program->delete();
        return redirect()->route('admin.donation_programs.index')
            ->with('success', 'Program telah dipadam.');
    }
public function getGrafanaStats(Request $request)
    {
        $range = $request->query('range', 'day'); // Default

        $host = '192.168.0.123';
        $port = 8086;
        $dbname = 'people_counter';

        try {
            $client = new \InfluxDB\Client($host, $port);
            $database = $client->selectDB($dbname);

            // LOGIK QUERY YANG DIPERBAIKI:
            
            if ($range == 'second') {
                // 5 SAAT: Guna COUNT (Kira setiap data yang masuk)
                // Papar data 5 minit terakhir
                $query = "SELECT count(global_count) as count FROM people_flow";
                $dateFormat = 'H:i:s'; 
                
            } elseif ($range == 'minute') {
                // MINIT: Guna COUNT (Supaya nampak '5' orang, bukan '1' purata)
                // Papar data 1 Jam lepas
                $query = "SELECT count(global_count) as count FROM people_flow WHERE time > now() - 1h GROUP BY time(1m) fill(0)";
                $dateFormat = 'H:i'; 
                
            } elseif ($range == 'hour') {
                // JAM: Guna MEAN (Untuk elak angka jadi ribuan jika orang duduk lama)
                // Papar data 24 Jam lepas
                $query = "SELECT round(mean(global_count)) as count FROM people_flow WHERE time > now() - 24h GROUP BY time(1h) fill(0)";
                $dateFormat = 'H:i'; 
                
            } else {
                // HARI/BULAN: Guna MEAN
                $query = "SELECT round(mean(global_count)) as count FROM people_flow WHERE time > now() - 30d GROUP BY time(1d) fill(0)";
                $dateFormat = 'd M'; 
            }

            $result = $database->query($query);
            $points = $result->getPoints();

            $labels = [];
            $data = [];

            foreach ($points as $point) {
                $timestamp = strtotime($point['time']);
                $labels[] = date($dateFormat, $timestamp);
                $data[] = $point['count'];
            }

            return response()->json([
                'labels' => $labels,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('InfluxDB Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}