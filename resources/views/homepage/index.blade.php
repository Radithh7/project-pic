@extends('layouts.app')

@section('title', 'Welcome to Toko Online')

@section('content')
    <!-- Banner -->
    <div class="jumbotron p-5 mb-4 bg-light rounded-3">
        <h1 class="display-4">Selamat Datang di SPW Online!</h1>
        <p class="lead">Temukan berbagai produk berkualitas dengan harga terbaik.</p>
        <a href="/category-product" class="btn btn-primary btn-lg">Jelajahi Kategori</a>
    </div>

    <!-- Produk Terbaru -->
    <h2 class="mb-4">Produk Terbaru</h2>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/'.$product->image) }}" class="rounded" style="width: 100%; height: 200px; object-fit: cover;" alt="{{ $product->nameproduct }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nameproduct }}</h5>
                        <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="/product/{{ $product->id }}" class="btn btn-success">Detail Produk</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
