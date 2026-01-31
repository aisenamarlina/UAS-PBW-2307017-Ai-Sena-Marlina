<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Redirect berdasarkan role setelah login
     */
    public function index() 
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->role == 'admin') {
            // Mengarahkan ke method adminIndex
            return redirect()->route('admin.dashboard');
        }

        return $this->userDashboard($user);
    }

    /**
     * Method ini yang dipanggil oleh Route /admin/dashboard
     * Pastikan namanya 'adminIndex' sesuai pesan error tadi
     */
    public function adminIndex()
    {
        // Statistik untuk Admin
        $recentTransactions = Order::with('user')->latest()->take(5)->get();
        $totalProducts = Product::count();
        $orderCount = Order::count();
        $totalRevenue = Order::whereIn('status', ['success', 'completed'])->sum('total_price');

        return view('admin.dashboard', compact(
            'totalProducts', 
            'orderCount', 
            'recentTransactions', 
            'totalRevenue'
        ));
    }

    /**
     * Logika Khusus User
     */
    private function userDashboard($user)
    {
        $orders = Order::where('user_id', $user->id)->latest()->take(5)->get();
        
        $cartCount = 0;
        if (class_exists('App\Models\Cart')) {
            $cartCount = \App\Models\Cart::where('user_id', $user->id)->count();
        }

        return view('user.dashboard', compact('orders', 'cartCount'));
    }
}