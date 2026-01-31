<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat Admin
        User::create([
            'name' => 'Admin CLC',
            'email' => 'admin@clc.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Membuat User Contoh
        User::create([
            'name' => 'Pelanggan Setia',
            'email' => 'user@clc.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }
}