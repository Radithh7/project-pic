@extends('layouts.dashboard')

@section('title', 'Detail Produk')

@section('content')
    <div class="card mb-4">
        <div class="row g-0">
            <div class="col-md-4 text-center p-3">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nameproduct }}" class="img-fluid rounded">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->nameproduct }}</h5>
                    <p class="card-text"><strong>Kategori:</strong> {{ $product->category->category_name }}</p>
                    <p class="card-text"><strong>Stok:</strong> {{ $product->stock }}</p>
                    <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                    @if ($product->description)
                        <p class="card-text"><strong>Deskripsi:</strong> {{ $product->description }}</p>
                    @endif
                    <a href="{{ route('dashboard.index') }}" class="btn btn-warning mt-3"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
