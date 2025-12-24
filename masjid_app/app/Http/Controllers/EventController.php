<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('event_date')->get();
        return view('admin.events.index', compact('events'));
    }

    // Admin methods
    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date|after:today',
            'capacity' => 'required|integer|min:1|max:1000',
            'venue' => 'required|string',
        ]);

        // Check for venue conflict (same venue, same date)
        $existingEvent = Event::where('venue', $request->venue)
            ->where('event_date', $request->event_date)
            ->first();

        if ($existingEvent) {
            return back()->withErrors([
                'venue' => 'An event already exists at this venue on the same date.'
            ])->withInput();
        }

        Event::create($request->all());

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'capacity' => 'required|integer|min:1|max:1000',
            'venue' => 'required|string',
        ]);

        // Check for venue conflict (same venue, same date, excluding current event)
        $existingEvent = Event::where('venue', $request->venue)
            ->where('event_date', $request->event_date)
            ->where('id', '!=', $event->id)
            ->first();

        if ($existingEvent) {
            return back()->withErrors([
                'venue' => 'An event already exists at this venue on the same date.'
            ])->withInput();
        }

        $event->update($request->all());

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully!');
    }

    public function dashboard()
    {
        $events = \App\Models\Event::orderBy('event_date')->get();
        return view('admin.dashboard', compact('events'));
    }

    // User Registration Method
    public function register(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        // Check if the user is already registered for this event
        $existingRegistration = DB::table('participant')
            ->where('email', Auth::user()->email)
            ->where('event_id', $request->event_id)
            ->first();

        if ($existingRegistration) {
            return redirect()->route('profile')->with('registration_success', 'You are already registered for this event!');
        }

        // Check event capacity
        $event = Event::find($request->event_id);
        $registeredCount = DB::table('participant')->where('event_id', $request->event_id)->count();
        if ($registeredCount >= $event->capacity) {
            return redirect()->route('profile')->with('registration_success', 'This event has reached its capacity!');
        }

        // Register the user
        DB::table('participant')->updateOrInsert(
            ['email' => Auth::user()->email, 'event_id' => $request->event_id],
            ['attendance_status' => 'Registered', 'created_at' => now(), 'updated_at' => now()]
        );

        return redirect()->route('profile')->with('registration_success', 'Successfully registered for the event!');
    }
}