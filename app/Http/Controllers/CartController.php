<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // Ambil foto produk. Sesuaikan 'image' dengan nama kolom di database Anda (misal: 'image' atau 'img')
        $productImage = $product->image ?? $product->img;

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name"     => $product->name,
                "quantity" => 1,
                "price"    => $product->price,
                "image"    => $productImage // Pastikan ini tidak kosong
            ];
        }

        session()->put('cart', $cart);

        // Logika untuk tombol "Beli Sekarang"
        if ($request->has('buy_now')) {
            return redirect()->route('cart.checkout', ['only' => $id]);
        }

        // Respons untuk AJAX (Penting agar script JavaScript di Blade jalan)
        if($request->ajax()) {
            return response()->json([
                'success' => true, 
                'message' => 'Produk ditambahkan ke keranjang!',
                'redirect' => route('cart.checkout', ['only' => $id]) // Tambahan untuk mempermudah JS
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function checkout(Request $request)
    {
        $allCart = session()->get('cart', []);
        
        if(empty($allCart)) {
            return redirect()->route('products.index')->with('error', 'Keranjang Anda masih kosong!');
        }

        $filteredCart = [];
        $onlyId = $request->query('only');
        $selectedItems = $request->query('selected_items');

        if ($onlyId && isset($allCart[$onlyId])) {
            $filteredCart = [$onlyId => $allCart[$onlyId]];
        } 
        elseif ($selectedItems) {
            $selectedIds = json_decode($selectedItems, true);
            if (is_array($selectedIds)) {
                foreach ($selectedIds as $id) {
                    if (isset($allCart[$id])) {
                        $filteredCart[$id] = $allCart[$id];
                    }
                }
            }
        } else {
            $filteredCart = $allCart;
        }
        
        return view('cart.checkout', ['cart' => $filteredCart]);
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric',
            'address' => 'required|min:10',
            'name' => 'required',
            'items' => 'required|array' 
        ]);

        $cart = session()->get('cart', []);
        if(empty($cart)) return redirect()->route('products.index');

        $total = 0;
        $purchasedIds = [];

        foreach($request->items as $id => $item) {
            if(isset($cart[$id])) {
                // Bersihkan format harga (Rp 200.000 -> 200000)
                $rawPrice = $cart[$id]['price'];
                $price = is_numeric($rawPrice) ? $rawPrice : (int) preg_replace('/[^0-9]/', '', $rawPrice);
                
                $total += $price * $item['quantity'];
                $purchasedIds[] = $id;
            }
        }

        Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => $total,
            'status' => 'pending',
            'payment_method' => $request->payment_method ?? 'COD',
        ]);

        foreach($purchasedIds as $id) {
            unset($cart[$id]);
        }
        
        if(empty($cart)) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }

        return redirect()->route('home')->with('success_checkout', 'Pesanan berhasil dikirim!');
    }

    public function destroy($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produk dihapus!');
    }
}