<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http; // ✅ TAMBAHAN (WAJIB API)

class ProductController extends Controller
{
    // =========================
    // KODE KAMU (TIDAK DIUBAH)
    // =========================

    public function index(Request $request) 
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        $products = $query->latest()->get(); 
        
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /* --- FUNGSI ADMIN --- */

    public function adminIndex() 
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'category'    => 'required',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'material'    => 'nullable|string',
            'dimensions'  => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk "Creating LC" berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'category'    => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'material'    => 'nullable|string',
            'dimensions'  => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Data produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk telah dihapus dari sistem.');
    }

    // =========================
    // 🔥 TAMBAHAN API (TIDAK MERUBAH KODE LAMA)
    // =========================

    public function apiProducts(Request $request)
    {
        $products = Http::get('https://fakestoreapi.com/products')->json();

        if ($request->filled('search')) {
            $products = collect($products)->filter(function ($item) use ($request) {
                return str_contains(
                    strtolower($item['title']),
                    strtolower($request->search)
                );
            });
        }

        return view('products.api', compact('products'));
    }
}
