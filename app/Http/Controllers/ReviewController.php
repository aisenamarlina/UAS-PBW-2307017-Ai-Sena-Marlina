<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required|min:5'
        ]);

        // Simpan review ke database
        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }
}