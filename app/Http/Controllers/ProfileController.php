<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Ambil data profile, atau buat jika belum ada (untuk user lama)
        $profile = $request->user()->profile()->firstOrCreate(
            ['user_id' => $request->user()->id]
        );

        return view('profile.edit', [
            'user' => $request->user(),
            'profile' => $profile, // <-- Kirim data profile ke view
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // 1. Update data user (nama, email) - bawaan Breeze
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        // 2. Update data profile (telepon, alamat)
        $profileData = $request->validate([
            'phone_number' => ['required', 'string', 'max:20'], // Sesuaikan validasi
            'address' => ['required', 'string'],
        ]);

        // Gunakan updateOrCreate untuk handle jika profile belum ada
        $request->user()->profile()->updateOrCreate(
            ['user_id' => $request->user()->id], // Kondisi pencarian
            $profileData // Data yang di-update atau dibuat
        );

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete(); // Profile akan terhapus otomatis karena onDelete('cascade')

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}