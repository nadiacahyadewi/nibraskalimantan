<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    $products = \App\Models\Product::with(['images', 'categoryData', 'brand'])->latest()->take(8)->get();
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

// RajaOngkir API routes untuk AJAX Frontend
//route to get cities based on province ID
Route::get('/cities/{provinceId}', [App\Http\Controllers\RajaOngkirController::class, 'getCities']);

//route to get districts based on city ID
Route::get('/districts/{cityId}', [App\Http\Controllers\RajaOngkirController::class, 'getDistricts']);

//route to post shipping cost
Route::post('/check-ongkir', [App\Http\Controllers\RajaOngkirController::class, 'checkOngkir']);


// Checkout Route (Public / Guest accessible agar bisa beli tanpa login)
Route::match(['get', 'post'], '/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process');

Route::middleware('auth')->group(function () {
    Route::get('/pesanan', [App\Http\Controllers\UserOrderController::class, 'index'])->name('orders.index');
    Route::get('/pesanan/{id}', [App\Http\Controllers\UserOrderController::class, 'show'])->name('orders.show');
    Route::post('/pesanan/{id}/complete', [App\Http\Controllers\UserOrderController::class, 'complete'])->name('orders.complete');
});

// Midtrans routes
Route::post('/midtrans/token', [App\Http\Controllers\MidtransController::class, 'getToken'])->name('midtrans.token');
Route::post('/midtrans/status', [App\Http\Controllers\MidtransController::class, 'checkStatus'])->name('midtrans.status');
Route::post('/midtrans/notification', [App\Http\Controllers\MidtransController::class, 'notification']);
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

    // Category and Brand routes
    Route::get('/category-brand', [App\Http\Controllers\Admin\CategoryBrandController::class, 'index'])->name('category_brand.index');
    Route::post('/categories', [App\Http\Controllers\Admin\CategoryBrandController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{category}', [App\Http\Controllers\Admin\CategoryBrandController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{category}', [App\Http\Controllers\Admin\CategoryBrandController::class, 'destroyCategory'])->name('categories.destroy');
    Route::post('/brands', [App\Http\Controllers\Admin\CategoryBrandController::class, 'storeBrand'])->name('brands.store');
    Route::put('/brands/{brand}', [App\Http\Controllers\Admin\CategoryBrandController::class, 'updateBrand'])->name('brands.update');
    Route::delete('/brands/{brand}', [App\Http\Controllers\Admin\CategoryBrandController::class, 'destroyBrand'])->name('brands.destroy');

    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('finance', App\Http\Controllers\Admin\FinanceController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update']);
    Route::post('/orders/{order}/ship', [App\Http\Controllers\Admin\OrderController::class, 'ship'])->name('orders.ship');
});
