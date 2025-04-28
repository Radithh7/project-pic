<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPW Online - Toko Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #fff;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .btn-rounded {
            border-radius: 50px;
        }
        .search-box input {
            border-radius: 50px;
        }
        .hero {
            padding: 4rem 0;
            background: #f9fafb;
        }
        .bg-light-gray {
            background: #f9fafb;
        }
        .carousel img {
            border-radius: 1rem;
        }
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 5px 10px rgba(0,0,0,0.05);
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .price-badge {
            background-color: #f1f3f5;
            color: #0d6efd;
            font-weight: 600;
            border-radius: 2rem;
            padding: 0.3rem 1rem;
            font-size: 0.9rem;
        }
        .card-title {
            font-size: 0.95rem;
            font-weight: 600;
            display: -webkit-box;
            -webkit-line-clamp: 2; /* maksimal 2 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            min-height: 2.8em; /* agar semua tinggi judul seragam */
        }

        .scroll-wrapper {
            overflow-x: auto;
            scroll-behavior: smooth;
            padding-bottom: 0.5rem;
        }
        .scroll-wrapper::-webkit-scrollbar {
            height: 8px;
        }
        .scroll-wrapper::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 10px;
        }


    </style>
</head>
<body class="bg-light-gray">
@include('layouts.navbar')

<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-5 fw-bold">Temukan <span class="text-primary">Produk Sekolah</span><br> Terbaik untuk Kamu!</h1>
                <p class="text-muted">Belanja perlengkapan sekolah dengan mudah dan terjangkau hanya di SPW Online.</p>
                <div class="mt-4 d-flex gap-3">
                    <a href="{{ route('product.showcategory') }}" class="btn btn-warning btn-rounded">Jelajahi Kategori</a>
                    <a href="#produk" class="btn btn-outline-secondary btn-rounded">Lihat Produk</a>
                </div>
            </div>
            <div class="col-md-6">
                <div id="produkTerbaruCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($products as $index => $product)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <a href="{{ route('product.show', ['id' => $product->id]) }}">
                                    <img src="{{ asset('storage/'.$product->image ?: 'images/default.jpg') }}" class="d-block w-100">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#produkTerbaruCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#produkTerbaruCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container py-5 bg-light-gray" id="produk">
    <h2 class="mb-4 text-center fw-bold text-primary">
        @if (!empty($query))
            Hasil Pencarian untuk "{{ $query }}"
        @else
            Produk Terbaru
        @endif
    </h2>

    <!-- Produk Terbaru -->
    <div class="bg-white p-3 rounded shadow-sm scroll-wrapper mb-5">
        <div class="d-flex flex-nowrap gap-3">
            @forelse ($products as $product)
                <div class="card shadow-sm border-0" style="min-width: 200px; max-width: 200px; flex: 0 0 auto;">
                    <div class="position-relative">
                        <img src="{{ asset('storage/'.$product->image ?: 'images/default.jpg') }}" class="card-img-top" style="height: 160px; object-fit: cover;">
                        <span class="badge bg-primary position-absolute top-0 start-0 m-2">Baru</span>
                    </div>
                    <div class="card-body text-center p-2 d-flex flex-column">
                        <h6 class="card-title mb-1">{{ \Illuminate\Support\Str::limit($product->nameproduct, 25) }}</h6>
                        <p class="price-badge mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <div class="d-flex justify-content-between align-items-center gap-1">
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-outline-primary w-100">
                                <i class="bi bi-eye"></i>
                            </a>
                            <form action="{{ route('cart.add') }}" method="POST" class="w-100">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-sm btn-primary w-100">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted ms-3">Tidak ada produk ditemukan.</p>
            @endforelse
        </div>
    </div>

    <!-- Produk Terlaris -->
    @unless(isset($isSearch) && $isSearch)
    <div class="py-5" id="produk-terlaris">
        <h2 class="mb-4 text-center fw-semibold text-dark">Produk Terlaris</h2>
        <div class="bg-white p-3 rounded shadow-sm scroll-wrapper">
            <div class="d-flex flex-nowrap gap-3">
                @forelse ($bestSellers as $product)
                    <div class="card shadow-sm border-0" style="min-width: 200px; max-width: 200px; flex: 0 0 auto;">
                        <div class="position-relative">
                            <img src="{{ asset('storage/'.$product->image ?: 'images/default.jpg') }}" class="card-img-top" style="height: 160px; object-fit: cover;">
                            <span class="badge bg-success position-absolute top-0 start-0 m-2">Terlaris</span>
                        </div>
                        <div class="card-body text-center p-2 d-flex flex-column">
                            <h6 class="card-title mb-1">{{ \Illuminate\Support\Str::limit($product->nameproduct, 25) }}</h6>
                            <p class="price-badge mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <span class="badge bg-light text-muted rounded-pill small mb-2">Terjual {{ $product->transactions_count }}x</span>
                            <div class="d-flex justify-content-between align-items-center gap-1">
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-outline-dark w-100">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('cart.add') }}" method="POST" class="w-100">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-sm btn-dark w-100">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted ms-3">Belum ada produk terlaris saat ini.</p>
                @endforelse
            </div>
        </div>
    </div>
    @endunless
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>