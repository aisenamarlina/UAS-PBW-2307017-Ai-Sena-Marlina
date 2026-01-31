<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem; 
use App\Models\Product;   
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * UNTUK ADMIN: Menampilkan daftar semua pesanan pelanggan
     */
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    /**
     * UNTUK ADMIN: Menampilkan Detail Pesanan (Memperbaiki error show method)
     */
    public function show($id)
    {
        // Mengambil pesanan beserta item produk di dalamnya
        $order = Order::with('items.product')->findOrFail($id);
        
        // Mengembalikan view detail yang kita buat sebelumnya
        return view('admin.orders.show', compact('order'));
    }

    /**
     * UNTUK ADMIN: Mengupdate status pesanan (Konfirmasi Masuk)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,shipped,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui ke ' . strtoupper($request->status));
    }

    /**
     * UNTUK PELANGGAN: Menampilkan daftar pesanan milik sendiri
     */
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('user.pesanan-saya', compact('orders'));
    }

    /**
     * UNTUK PELANGGAN: Proses Simpan Checkout
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $cart = session()->get('cart');

        if (!$cart) {
            return redirect()->route('products.index')->with('error', 'Keranjang belanja kosong.');
        }

        return DB::transaction(function () use ($request, $cart) {
            
            $totalPrice = array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $cart));

            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'total_price' => $totalPrice,
                'status' => 'pending', 
                'payment_method' => $request->payment_method ?? 'COD',
            ]);

            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
                
                $product = Product::find($id);
                if ($product) {
                    // Pastikan stok tidak negatif
                    if ($product->stock < $details['quantity']) {
                        throw new \Exception("Stok produk {$product->name} tidak mencukupi.");
                    }
                    $product->decrement('stock', $details['quantity']);
                }
            }

            // LOGIKA POIN
            $user = User::find(Auth::id());
            $pointsEarned = floor($totalPrice / 1000); 
            $user->increment('loyalty_points', $pointsEarned);

            session()->forget('cart');

            // Gunakan route my_orders agar sesuai dengan dashboard user
            return redirect()->route('orders.my_orders')->with('success', 'Pesanan berhasil! Anda mendapatkan ' . $pointsEarned . ' poin.');
        });
    }
}