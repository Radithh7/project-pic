@extends('layouts.app')

@section('content')
    <!-- Banner -->
    <h2 class="mb-4">Detail Produk</h2>
    <div class="row">
        @forelse ($products as $item)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $item->image) }}" 
                        class="rounded" 
                        style="width: 100%; height: 200px; object-fit: cover;" 
                        alt="{{ $item->nameproduct ?? 'Produk Tanpa Nama' }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nameproduct ?? 'Nama Tidak Tersedia' }}</h5>
                        <p class="card-text">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Produk tidak tersedia saat ini.</p>
        @endforelse
    </div>
@endsection
