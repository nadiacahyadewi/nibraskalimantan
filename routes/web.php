<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    $products = \App\Models\Product::with('images')->latest()->take(8)->get();
    return view('welcome', compact('products'));
})->name('home');

Route::get('/produk', [ProductController::class, 'index'])->name('produk');
Route::get('/produk/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/keranjang/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/keranjang/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/keranjang/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
});
// Guest routes for login and register
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin protected routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
});
