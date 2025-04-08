<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(6)->get(); // Ambil 6 produk terbaru
        return view('homepage.index', compact('products'));
    }
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('homepage.detail', compact('product'));
    }
    public function showCategoryWithProducts()
    {
        $categories = Category::with('products')->get();
        return view('homepage.by-category', compact('categories'));
    }
}
