<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SolatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ParticipantController;
use App\Models\Event;
use App\Models\DonationProgram; // Import Model ini
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Public Routes (Boleh diakses oleh semua)
|--------------------------------------------------------------------------
*/

// Halaman Utama (Welcome)
Route::get('/', function () {
    // 1. Ambil acara akan datang
    $events = Event::where('event_date', '>=', now())
                   ->orderBy('event_date', 'asc')
                   ->take(6)
                   ->get();

    // 2. Ambil program sumbangan yang AKTIF (Untuk bahagian #donasi)
    $donationPrograms = DonationProgram::where('status', 'active')->get();
                   
    return view('welcome', compact('events', 'donationPrograms'));
})->name('home');

Route::get('/calendar', [EventController::class, 'index'])->name('calendar');

// Laluan untuk proses sumbangan (AJAX)
Route::post('/donation/submit', [DonationController::class, 'store'])->name('donation.store');

/*
|--------------------------------------------------------------------------
| PARTICIPANT Routes (Orang Awam)
| Guard: participant
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:participant'])->group(function () {
    
    // Dashboard Participant
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Management
    Route::get('/Participant/profile', [ProfileController::class, 'show'])->name('Participant.profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    
    // Event Registration
    Route::get('/Participant/event/register', [ProfileController::class, 'showRegistrationForm'])->name('event.registration');
    Route::post('/Participant/event/register', [ProfileController::class, 'register'])->name('event.register');
    Route::get('/Participant/registrations', [ProfileController::class, 'myRegistrations'])->name('participant.registrations');
    
    // Join Event Logic
    Route::post('/event/{id}/join', [ParticipantController::class, 'joinEvent'])->name('event.join');

    // Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatController::class, 'send'])->name('chat.send');

    // Sejarah Derma
    Route::get('/history', function () {
        $user = Auth::guard('participant')->user();
        $donations = $user->donations()->orderBy('created_at', 'desc')->paginate(10);
        return view('user.history', compact('donations'));
    })->name('user.history');
});

/*
|--------------------------------------------------------------------------
| COMMITTEE Routes (Admin/AJK)
| Guard: committee
| Prefix URL: /admin
| Route Name Prefix: admin.
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:committee'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Event Management
    // Route resource automatik hasilkan: admin.events.index, admin.events.create, dll.
    Route::resource('events', EventController::class);

    // Registrations Management
    Route::get('/registrations', [AdminController::class, 'indexRegistrations'])->name('registrations.index');
    Route::patch('/registrations/{registration}/approve', [AdminController::class, 'approveRegistration'])->name('registrations.approve');
    Route::patch('/registrations/{registration}/reject', [AdminController::class, 'rejectRegistration'])->name('registrations.reject');
    
    // Service Requests Management
    Route::get('/service_requests', [AdminController::class, 'indexServiceRequest'])->name('service_requests.index');
    Route::get('/service_requests/create', [AdminController::class, 'createServiceRequest'])->name('service_requests.create');
    Route::post('/service_requests', [AdminController::class, 'storeServiceRequest'])->name('service_requests.store');
    
    // Notifications
    Route::get('/notifications/send', [AdminController::class, 'sendNotifications'])->name('notifications.send');

    // Donations Management (Senarai Transaksi)
    Route::get('/donations', [AdminController::class, 'indexDonations'])->name('donations.index');
    Route::patch('/donations/{donation}/verify', [AdminController::class, 'verifyDonation'])->name('donations.verify');
    Route::patch('/donations/{donation}/reject', [AdminController::class, 'rejectDonation'])->name('donations.reject');

    // --- PENGURUSAN PROGRAM SUMBANGAN (CRUD) ---
    // URL: /admin/donation-programs
    // Nama Route: admin.donation_programs.index, admin.donation_programs.create, dll.
    Route::get('/donation-programs', [AdminController::class, 'indexDonationPrograms'])->name('donation_programs.index');
    Route::get('/donation-programs/create', [AdminController::class, 'createDonationProgram'])->name('donation_programs.create');
    Route::post('/donation-programs', [AdminController::class, 'storeDonationProgram'])->name('donation_programs.store');
    Route::delete('/donation-programs/{program}', [AdminController::class, 'destroyDonationProgram'])->name('donation_programs.destroy');
    Route::get('/api/visit-stats', [AdminController::class, 'getGrafanaStats'])->name('api.visit_stats');
});

require __DIR__ . '/auth.php';