<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Paparkan view login untuk Orang Awam (Participant).
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login untuk Orang Awam (Participant).
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->ensureIsNotRateLimited();

        // Login guna guard 'participant'
        if (! Auth::guard('participant')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->authenticate(); 
        }

        $request->session()->regenerate();

        // UBAH DI SINI: Redirect ke 'home' (index) dan bukan 'dashboard'
        return redirect()->intended(route('home', absolute: false));
    }

    /**
     * Logout untuk Orang Awam.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('participant')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // ==========================================
    // BAHAGIAN UNTUK ADMIN / COMMITTEE
    // ==========================================

    public function createCommittee(): View
    {
        return view('auth.committee-login');
    }

    public function storeCommittee(LoginRequest $request): RedirectResponse
    {
        $request->ensureIsNotRateLimited();

        if (! Auth::guard('committee')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        // Admin kekal ke Dashboard Admin
        return redirect()->intended(route('admin.dashboard', absolute: false));
    }

    public function destroyCommittee(Request $request): RedirectResponse
    {
        Auth::guard('committee')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}