<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipantAuthController extends Controller
{
    // Tunjuk form login
    public function showLoginForm()
    {
        return view('auth.participant-login'); // Anda kena buat view ini
    }

    // Proses login
    public function login(Request $request)
    {
        // 1. Validate data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cuba login guna guard 'participant'
        // 'attempt' akan automatik hash password dan check dalam table participants
        if (Auth::guard('participant')->attempt($credentials)) {
            $request->session()->regenerate();

            // Login berjaya, redirect ke dashboard participant
            return redirect()->intended('/participant/dashboard');
        }

        // 3. Login gagal
        return back()->withErrors([
            'email' => 'Emel atau kata laluan salah.',
        ]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::guard('participant')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}