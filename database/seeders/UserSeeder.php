<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::create([
            'name' => 'Admin Dukunify',
            'email' => 'admin@dukunify.com',
            'password' => Hash::make('password'), 
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Akun Klien (Contoh)
        User::create([
            'name' => 'Klien Satu',
            'email' => 'klien@dukunify.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
    }
}