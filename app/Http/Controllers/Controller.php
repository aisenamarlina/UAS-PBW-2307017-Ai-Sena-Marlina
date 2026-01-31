<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
// Tambahkan ini agar sistem bisa mengingat apa yang dibeli
use Illuminate\Support\Facades\Session; 

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function prosesCheckout(Request $request)
    {
        // 1. Validasi untuk memastikan ID produk ada
        $request->validate([
            'product_id' => 'required'
        ]);

        // 2. Ambil data produk
        $productId = $request->input('product_id');

        // 3. Simpan ke Session (Agar di halaman checkout datanya muncul)
        // Kita simpan ID produk ini dengan nama 'checkout_item'
        Session::put('checkout_item', $productId);
        
        // 4. REDIRECT ke halaman checkout
        // Pastikan di web.php sudah ada route dengan ->name('checkout.index')
        return redirect()->route('checkout.index');
    }
}