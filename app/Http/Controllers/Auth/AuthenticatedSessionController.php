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
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // --- START OF MODIFICATION ---

        // Get the authenticated user
        $user = Auth::user();

        // Check the user's role and redirect accordingly
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        } else {
            // Default for 'user' role or any other role
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // --- END OF MODIFICATION ---
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}