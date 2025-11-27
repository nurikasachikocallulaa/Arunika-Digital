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
        // Gunakan view berbeda untuk login user dan admin
        if (request()->routeIs('admin.login')) {
            return view('auth.login'); // Halaman login admin
        }

        return view('auth.user-login'); // Halaman login user biasa
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        
        $user = $request->user();

        if ($user && $user->status !== 'active') {
            Auth::guard('web')->logout();

            return back()->withErrors([
                'email' => 'Akun Anda belum aktif. Silakan hubungi admin utama.',
            ])->onlyInput('email');
        }

        // Jika login melalui /admin/login, pastikan user adalah admin
        if ($request->routeIs('admin.login') && (!$user || !$user->is_admin)) {
            Auth::guard('web')->logout();

            return back()->withErrors([
                'email' => 'Anda tidak memiliki akses sebagai admin.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        // Redirect berdasarkan role user
        if ($user->is_admin) {
            // Jika admin, arahkan ke dashboard admin
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Jika user biasa, arahkan ke halaman guest
        return redirect()->intended(route('guest.home'));
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
