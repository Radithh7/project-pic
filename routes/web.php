<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;



// Homepage untuk user yang sudah login
Route::group(['middleware' => 'auth:user'], function() {
    Route::get('/', [HomeController::class, 'index'])->name('user.dashboard.index');
    
    //Search
    Route::get('/search', [ProductController::class, 'search'])->name('product.search');
    Route::get('/search/category', [HomeController::class, 'search'])->name('product-category.search');

    //Kategori Produk
    Route::get('/kategori', [HomeController::class, 'showCategoryWithProducts'])->name('product-category.index');
    Route::get('/kategori/{id}', [HomeController::class, 'filterCategory'])->name('product-category.filter');
    
    //View Product
    Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');
    Route::get('/product-category-view', [HomeController::class, 'showCategoryWithProducts'])->name('product.showcategory');
    
    //Checkout
    Route::get('/checkout', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/checkout', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/checkout', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/checkout', [TransactionController::class, 'store'])->name('transactions.store');
    Route::post('/midtrans/callback', [TransactionController::class, 'handleCallback']);
    Route::get('/payment-success', [TransactionController::class, 'paymentSuccess']);
    Route::post('/transactions/buy-cash', [TransactionController::class, 'buyWithCash'])->name('transactions.cash');
    Route::post('/transactions/token', [TransactionController::class, 'getSnapToken'])->name('transactions.token');

    //Snap Token
    Route::post('/transactions/get-snap-token', [TransactionController::class, 'getSnapToken'])->name('transactions.getSnapToken');
    Route::post('/transactions/payment-success', [TransactionController::class, 'paymentSuccess'])->name('transactions.payment.success');

    //Keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    //Transaksi
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
});

// Homepage untuk admin yang sudah login
Route::group(['middleware' => 'auth:admin'], function() {
    Route::resource('/dashboard', ProductController::class)->names('admin.dashboard');
    Route::post('/dashboard/create', [ProductController::class, 'create'])->name('dashboard.create');
    Route::resource('/category-product', \App\Http\Controllers\CategoryController::class);

    //Transaksi Admin
    Route::get('/admin/transactions', [TransactionController::class, 'adminIndex'])->name('admin.transactions');
    Route::patch('/admin/transactions/{transaction}/status', [TransactionController::class, 'updateStatus'])->name('admin.transactions.update');
});

// Rute untuk guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest:admin,user');
    Route::post('/login', [AuthController::class, 'verify'])->name('auth.verify'); // Pastikan menggunakan verify untuk login

    // Halaman Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest:admin,user');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

// Rute untuk logout (gunakan POST, lebih aman)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

