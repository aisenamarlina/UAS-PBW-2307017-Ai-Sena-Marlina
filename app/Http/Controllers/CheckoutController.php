<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Pastikan Anda punya model Order
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // 1. Validasi data masuk
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $cart = session()->get('cart', []);

        if(empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        // 2. Hitung Total
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 3. Simpan ke tabel Orders (Ini yang membuat angka di Dashboard jadi 1)
        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => $total,
            'status' => 'pending', // Status awal
            'payment_method' => 'COD',
        ]);

        // 4. Kosongkan keranjang setelah berhasil
        session()->forget('cart');

        // 5. Kembali ke halaman checkout dengan tanda sukses
        return redirect()->back()->with('success_checkout', true);
    }
}