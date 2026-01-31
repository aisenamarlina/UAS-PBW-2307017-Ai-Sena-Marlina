<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini untuk praktik terbaik

class UserController extends Controller
{
    public function index()
    {
        // Mengambil data user yang sedang login
        $user = Auth::user();
        
        // Pastikan file view ada di resources/views/user/profile.blade.php
        return view('user.profile', compact('user'));
    }
}