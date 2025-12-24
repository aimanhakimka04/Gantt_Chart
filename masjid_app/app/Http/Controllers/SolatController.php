<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Event;

class SolatController extends Controller
{
    public function getPrayerTimes()
    {
        $today = Carbon::now()->format('d-m-Y'); 
        $response = Http::get('https://api.aladhan.com/v1/timingsByCity', [
            'city' => 'Melaka',
            'country' => 'Malaysia',
            'method' => 3,
            'date' => $today,
        ]);

        $data = $response->json();

        if ($response->failed()) {
            return view('welcome')->with('error', 'Failed to fetch prayer times.');
        }

        $prayerTimes = $data['data']['timings'];
        $malayPrayerTimes = [
            'Subuh' => $prayerTimes['Fajr'],
            'Zohor' => $prayerTimes['Dhuhr'],
            'Asar' => $prayerTimes['Asr'],
            'Maghrib' => $prayerTimes['Maghrib'],
            'Isyak' => $prayerTimes['Isha'],
        ];

        // Get upcoming events (next 7 days)
        $upcomingEvents = Event::where('event_date', '>=', Carbon::now())
            ->where('event_date', '<=', Carbon::now()->addDays(7))
            ->orderBy('event_date')
            ->take(4)
            ->get();

        return view('welcome', compact('malayPrayerTimes', 'today', 'upcomingEvents'));
    }
}