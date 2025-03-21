<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::resource('/dashboard', \App\Http\Controllers\ProductController::class);
Route::resource('/category-product', \App\Http\Controllers\CategoryController::class);
