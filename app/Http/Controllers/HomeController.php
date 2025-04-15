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
    public function index(Request $request)
    {
        $query = $request->query('query');

        $products = Product::when($query, function ($q) use ($query) {
            $q->where('nameproduct', 'like', "%$query%");
        })->latest()->take(6)->get();

        // Ambil produk berdasarkan total pembelian (jumlah transaksi)
        $bestSellers = Product::withCount('transactions')
            ->orderBy('transactions_count', 'desc')
            ->take(6)
            ->get();

        return view('homepage.index', compact('products', 'query', 'bestSellers'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        $categories = Category::with('products')->get();

        $products = Product::where('nameproduct', 'like', "%$query%")->get();

        $bestSellers = Product::withCount('transactions')
            ->orderBy('transactions_count', 'desc')
            ->take(6)
            ->get();

        return view('homepage.by-category', [
            'categories' => $categories,
            'products' => $products,
            'query' => $query,
            'bestSellers' => $bestSellers
        ]);
    }



    public function filterCategory($id)
    {
        $categories = Category::with('products')->get(); // untuk sidebar
        $selectedCategory = Category::with('products')->findOrFail($id);
        $products = $selectedCategory->products;

        return view('homepage.by-category', compact('categories', 'products'));
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
