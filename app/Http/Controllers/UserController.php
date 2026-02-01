<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }

    public function update(Request $request)
{
    $user = auth()->user(); // Mengambil data user yang sedang login

    // Validasi data yang dikirim dari form
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:15',
        'birthday' => 'nullable|date',
        'bio' => 'nullable|string',
    ]);

    // Update data di database
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'birthday' => $request->birthday,
        'bio' => $request->bio,
    ]);

    // Jika password diisi, maka update password
    if ($request->filled('password')) {
        $user->update(['password' => bcrypt($request->password)]);
    }

    return back()->with('success', 'Profil berhasil diperbarui!');
}
}