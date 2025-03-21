<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(6)->get(); // Ambil 6 produk terbaru
        return view('homepage.index', compact('products'));
    }
    public function show(string $id)
    {
        $product = Product::all()->findOrFail($id);
        return view('homepage.show', compact('product'));
    }
}
