<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama (homepage) dengan 6 produk terbaru
     */
    public function index()
    {
        $products = Product::latest()->take(6)->get();

        // Pastikan view ini ada: resources/views/homepage/index.blade.php
        return view('homepage.index', compact('products'));
    }

    /**
     * Tampilkan detail produk berdasarkan ID
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        // View ini: resources/views/homepage/detail.blade.php
        return view('homepage.detail', compact('product'));
    }

    /**
     * Tampilkan semua kategori dengan produk-produknya
     */
    public function showCategoryWithProducts()
    {
        $categories = Category::with('products')->get();

        // View ini: resources/views/homepage/by-category.blade.php
        return view('homepage.by-category', compact('categories'));
    }
}
