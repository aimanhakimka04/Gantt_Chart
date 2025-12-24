<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Participant; // PENTING: Guna model Participant
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Check email dalam table participants, bukan users
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Participant::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create Participant (Bukan User biasa)
        $user = Participant::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Auto login guna guard 'participant'
        Auth::guard('participant')->login($user);

        return redirect(route('home', absolute: false));
    }
}