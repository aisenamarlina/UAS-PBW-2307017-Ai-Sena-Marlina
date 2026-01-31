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
        return $this->add($request, $id);
    }

    public function checkout(Request $request)
    {
        $allCart = session()->get('cart', []);
        
        if(empty($allCart)) {
            return redirect()->route('products.index')->with('error', 'Keranjang Anda masih kosong!');
        }

        // Variabel untuk menampung item yang akan ditampilkan di checkout saja
        $filteredCart = [];

        // SKENARIO 1: Dari tombol "Beli Sekarang" (parameter 'only')
        $onlyId = $request->query('only');

        // SKENARIO 2: Dari halaman Keranjang (parameter 'selected_items' dalam format JSON)
        $selectedItems = $request->query('selected_items');

        if ($onlyId && isset($allCart[$onlyId])) {
            // Hanya ambil satu item ini
            $filteredCart = [$onlyId => $allCart[$onlyId]];
        } 
        elseif ($selectedItems) {
            // Decode JSON ["2", "3"] menjadi array PHP
            $selectedIds = json_decode($selectedItems, true);
            if (is_array($selectedIds)) {
                foreach ($selectedIds as $id) {
                    if (isset($allCart[$id])) {
                        $filteredCart[$id] = $allCart[$id];
                    }
                }
            }
        } else {
            // Jika tidak ada parameter, default tampilkan semua (atau arahkan balik)
            $filteredCart = $allCart;
        }
        
        // Kirim $filteredCart ke view sebagai $cart
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
                // Bersihkan format harga (titik/koma)
                $price = (int) str_replace(['.', ','], '', $cart[$id]['price']);
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

        // Hapus hanya barang yang sudah dibayar dari keranjang session
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

    public function add(Request $request, $id) 
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        // Jika beli sekarang, bawa parameter 'only' agar checkout memfilter item lain
        if($request->redirect == 'cart') {
            return redirect()->route('cart.checkout', ['only' => $id]); 
        }

        if($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Produk ditambahkan!');
    }
}
