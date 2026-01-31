<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    ProductController,
    CartController,
    WishlistController,
    ReviewController,
    ChatController,
    DashboardController,
    OrderController,
    UserController
};

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing');
})->name('home');

// Produk Lokal
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// 🔥 Produk dari Public API (Fake Store API)
Route::get('/api-products', [ProductController::class, 'apiProducts'])
    ->name('products.api');

// Authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Member Routes (Auth)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'index'])->name('user.profile');

    Route::get('/pesanan-saya', [OrderController::class, 'myOrders'])
        ->name('orders.my_orders');

    // Keranjang & Checkout
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{id}', [CartController::class, 'store'])->name('add');
        Route::post('/update/{id}', [CartController::class, 'update'])->name('update');
        Route::delete('/remove/{id}', [CartController::class, 'destroy'])->name('remove');
        Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::post('/process', [OrderController::class, 'store'])->name('process');
    });

    Route::get('/checkout-success', function () {
        return view('checkout-success');
    })->name('checkout.success');

    // Wishlist
    Route::prefix('wishlist')->name('wishlist.')->group(function () {
        Route::get('/', [WishlistController::class, 'index'])->name('index');
        Route::post('/', [WishlistController::class, 'store'])->name('store');
        Route::delete('/{id}', [WishlistController::class, 'destroy'])->name('destroy');
    });

    // Review
    Route::post('/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');

    // Chat (Member & Admin)
    Route::prefix('chat')->name('chats.')->group(function () {
        Route::get('/{receiver_id}', [ChatController::class, 'index'])->name('index');
        Route::post('/send', [ChatController::class, 'sendMessage'])->name('store');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'adminIndex'])
        ->name('dashboard');

    // Management Pesanan
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])
        ->name('orders.updateStatus');

    // Chat Inbox Admin
    Route::get('/inbox', [ChatController::class, 'adminInbox'])
        ->name('chat.inbox');

    // CRUD Produk
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'adminIndex'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');
    });

    // Laporan & Pengaturan
    Route::get('/reports', fn () => view('admin.reports.index'))->name('reports');
    Route::get('/toko', fn () => view('admin.toko'))->name('toko');
    Route::get('/settings', fn () => view('admin.settings'))->name('settings');
});
