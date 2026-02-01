<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menampilkan halaman Register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses Registrasi
    public function register(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Simpan ke Database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default sebagai pelanggan
        ]);

        // 3. Langsung Login setelah daftar
        Auth::login($user);

        // 4. Arahkan ke Dashboard
        return redirect()->route('dashboard')->with('success', 'Selamat datang! Pendaftaran berhasil.');
    }

    // Proses Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Ambil user yang baru login
            $user = Auth::user();

            // Logika pengalihan: Jika admin ke admin.dashboard, jika user ke dashboard
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat Datang Admin!');
            }

            return redirect()->intended(route('dashboard'))->with('success', 'Selamat Datang Kembali!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        // Menghapus session agar benar-benar bersih dan aman
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }
}