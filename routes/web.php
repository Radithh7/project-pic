<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');
Route::get('/product-category-view', [HomeController::class, 'showCategoryWithProducts'])->name('product.showcategory');

Route::resource('/dashboard', \App\Http\Controllers\ProductController::class);
Route::resource('/category-product', \App\Http\Controllers\CategoryController::class);
