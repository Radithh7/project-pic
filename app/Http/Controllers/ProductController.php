<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $category = Category::all();
        return view('product-table.index', compact('products', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('product-table.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nameproduct'   => 'required|min:5',
            'categories_id' => 'required|numeric',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric',
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }

        Product::create($validatedData);

        return redirect()->route('dashboard.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('product-table.detail');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();
        return view('product-table.edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nameproduct'   => 'required|min:5',
            'categories_id' => 'required|numeric',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric',
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && Storage::exists('public/images/' . $product->image)) {
                Storage::delete('public/images/' . $product->image);
            }
            // Simpan gambar baru
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        } else {
            // Jika tidak ada gambar baru, jangan ubah field image
            unset($validatedData['image']);
        }

        // Update data produk
        $product->update($validatedData);

        return redirect()->route('dashboard.index')->with(['success' => 'Data Berhasil Diperbarui!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        //delete image
        Storage::delete('public/images/' . $product->image);

        //delete product
        $product->delete();

        //redirect to index
        return redirect()->route('dashboard.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
