<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    // Fungsi untuk Participant Join Event
    public function joinEvent($eventId)
    {
        $participant = Auth::guard('participant')->user();
        $event = Event::findOrFail($eventId);

        // 1. Semak jika sudah daftar
        $existingRegistration = Registration::where('participant_id', $participant->id)
                                            ->where('event_id', $eventId)
                                            ->first();

        if ($existingRegistration) {
            return redirect()->back()->with('error', 'Anda telah pun mendaftar untuk program ini.');
        }

        // 2. Semak kapasiti (Optional)
        $currentCount = Registration::where('event_id', $eventId)->where('status', 'approved')->count();
        if ($event->capacity && $currentCount >= $event->capacity) {
            return redirect()->back()->with('error', 'Maaf, pendaftaran telah penuh.');
        }

        // 3. Cipta Pendaftaran
        Registration::create([
            'participant_id' => $participant->id,
            'event_id' => $event->id,
            'status' => 'pending', // Default pending, tunggu admin approve
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berjaya! Sila tunggu kelulusan admin.');
    }
}