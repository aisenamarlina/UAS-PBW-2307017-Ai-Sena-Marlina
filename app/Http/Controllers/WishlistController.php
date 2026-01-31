<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        // Asumsi Anda memiliki relasi wishlist di model User
        $wishlistItems = Auth::user()->wishlist ?? collect([]);
        return view('wishlist.index', compact('wishlistItems'));
    }

    public function store(Request $request)
    {
        // Logika sederhana: simpan ID produk ke database atau session
        return back()->with('success', 'Produk berhasil ditambah ke wishlist!');
    }

    public function destroy($id)
    {
        // Logika hapus wishlist
        return back()->with('success', 'Produk dihapus dari wishlist');
    }
}