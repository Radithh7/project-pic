<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;

//Homepage
Route::group(['middleware'=>'auth:user'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('user.dashboard.index');
    Route::get('/search', [ProductController::class, 'search'])->name('product.search');
    Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');
    Route::get('/product-category-view', [HomeController::class, 'showCategoryWithProducts'])->name('product.showcategory');
    Route::get('/checkout', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/checkout', [TransactionController::class, 'store'])->name('transactions.store');
});

//Dashboard Admin
Route::group(['middleware'=>'auth:admin'], function(){
    Route::resource('/dashboard', ProductController::class)->names('admin.dashboard');
    Route::get('/dashboard/create', [ProductController::class, 'create'])->name('dashboard.create');
    
    Route::resource('/category-product', \App\Http\Controllers\CategoryController::class);
});

//Beli
Route::get('/checkout', [TransactionController::class, 'create'])->name('transactions.create');
Route::post('/checkout', [TransactionController::class, 'store'])->name('transactions.store');

//Login
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest:admin,user');
Route::post('/login', [AuthController::class, 'verify'])->name('auth.verify');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
