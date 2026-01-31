<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator CLC',
            'email' => 'adminclc@gmail.com',
            'password' => Hash::make('123123'),
            'role' => 'admin', // Memastikan dia memiliki akses admin
        ]);
    }
}