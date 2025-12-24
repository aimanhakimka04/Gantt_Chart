<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show()
    {
        return view('Participant.profile.show', ['user' => Auth::user()]);
    }

    public function edit()
    {
        $events = Event::orderBy('event_date')->get(); // Fetch events for dropdown
        return view('profile', compact('events'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        Auth::user()->update($request->all());
        return redirect()->route('Participant.profile.show')->with('success', 'Profile updated successfully!');
    }

    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Account deleted successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current-password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('Participant.profile.show')->with('success', 'Password updated successfully!');
    }

    // Moved from AdminController: Store a new event (adapted for participant context if needed)
    public function storeEvent(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'capacity' => 'required|integer|min:1',
        ]);
        Event::create($validated);
        return redirect()->route('profile.edit')->with('success', 'Event created.');
    }

    // Show event registration form
    public function showRegistrationForm()
    {
        $events = Event::where('event_date', '>', now())->orderBy('event_date')->get();
        return view('Participant.profile.event.event-registration', compact('events'));
    }

    // Handle event registration
    public function register(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        $participant = Auth::user();

        // Check if already registered for this event
        $existingRegistration = Registration::where('participant_id', $participant->id)
            ->where('event_id', $request->event_id)
            ->first();

        if ($existingRegistration) {
            return redirect()->route('event.registration')->with('registration_success', 'You are already registered for this event!');
        }

        // Check event capacity
        $event = Event::find($request->event_id);
        $registeredCount = Registration::where('event_id', $request->event_id)->count();
        if ($registeredCount >= $event->capacity) {
            return redirect()->route('event.registration')->with('registration_success', 'This event has reached its capacity!');
        }

        // Create registration
        Registration::create([
            'participant_id' => $participant->id,
            'event_id' => $request->event_id,
            'status' => 'pending'
        ]);

        return redirect()->route('event.registration')->with('registration_success', 'Successfully registered for the event!');
    }

    public function myRegistrations()
    {
        $participant = Auth::user();
        $registrations = Registration::where('participant_id', $participant->id)
            ->with('event')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('Participant.registrations.my-registrations', compact('registrations'));
    }
}