<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        if (request()->routeIs('admin.register')) {
            return view('auth.register'); // Halaman Daftar Admin
        }

        return view('auth.user-register'); // Halaman Daftar User
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Jika pendaftaran melalui /admin/register, buat akun admin
        if ($request->routeIs('admin.register')) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => true,
                'role' => 'petugas',
                'status' => 'pending',
            ]);

            event(new Registered($user));

            return redirect()->route('admin.login')->with('status', 'Pendaftaran berhasil, menunggu persetujuan admin utama.');
        }

        // Selain itu, anggap sebagai pendaftaran user biasa
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false,
            'role' => 'user',
            'status' => 'active',
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('status', 'Pendaftaran user berhasil, silakan login.');
    }
}
