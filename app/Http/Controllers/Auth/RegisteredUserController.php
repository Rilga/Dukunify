<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile; // <-- Pastikan ini ada
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Buat User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'role' akan otomatis 'user' karena default di migrasi
        ]);

        // =============================================
        // ==      BUAT PROFIL OTOMATIS             ==
        // =============================================
        // Buat record Profile yang terhubung ke User baru
        Profile::create(['user_id' => $user->id]);
        // =============================================

        // Kirim event Registered (untuk verifikasi email, dll)
        event(new Registered($user));

        // Login user yang baru dibuat
        Auth::login($user);

        // Redirect ke dashboard (middleware / RouteServiceProvider akan
        // mengarahkan ke dashboard yang benar berdasarkan role)
        return redirect(route('dashboard', absolute: false));
    }
}