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
            background-color: #f8f9fa;
        }
        .price-tag {
            background-color: #e7f1ff;
            color: #0d6efd;
            font-weight: 600;
            padding: 0.3rem 1rem;
            border-radius: 999px;
            display: inline-block;
            margin-bottom: 0.75rem;
        }
        .search-box input[type="text"] {
            border-radius: 999px;
            padding: 0.5rem 1.2rem;
        }
        .card:hover {
            transform: scale(1.03);
            transition: 0.3s ease;
        }
        .navbar {
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white py-3">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="#">SPW Online</a>

        <form action="{{ route('product.search') }}" method="GET" class="d-flex mx-auto" style="width: 50%;">
            <input name="query" class="form-control rounded-pill px-4" type="search" placeholder="Cari produk...">
            <button class="btn btn-warning rounded-pill ms-2 px-4"><i class="bi bi-search"></i></button>
        </form>

        <div class="d-flex align-items-center gap-3">
            @auth
                <a href="{{ route('transactions.index') }}" class="text-dark"><i class="bi bi-clock-history fs-5"></i></a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link text-danger p-0"><i class="bi bi-box-arrow-right fs-5"></i></button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-dark"><i class="bi bi-box-arrow-in-right fs-5"></i></a>
            @endauth
            <a href="{{ route('cart.index') }}" class="btn btn-cart relative"><i class="bi bi-cart fs-5"></i>
                @if($totalCartItems > 0)
                    <span class="absolute -top-1 -right-2 bg-red-600 text-white rounded-full px-2 text-xs">
                        {{ $totalCartItems }}
                    </span>
                @endif
            </a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-5 fw-bold mt-3">
                    Temukan <span class="text-primary">Produk Sekolah</span><br> Terbaik untuk Kamu!
                </h1>
                <p class="text-muted mt-3">Belanja perlengkapan sekolah dengan mudah, cepat, dan harga terjangkau hanya di SPW Online.</p>
                <div class="mt-4 d-flex gap-3">
                    <a href="{{ route('product.showcategory') }}" class="btn btn-warning px-4 py-2 rounded-pill">Jelajahi Kategori</a>
                    <a href="#produk" class="btn btn-outline-secondary px-4 py-2 rounded-pill">Lihat Produk</a>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Carousel Produk Terbaru -->
                <div id="produkTerbaruCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($products as $index => $product)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <!-- Debug URL gambar -->
                                <a href="{{ route('product.show', ['id' => $product->id]) }}">
                                    <img src="{{ asset('storage/'.$product->image ?: 'images/default.jpg') }}" class="d-block w-100" alt="{{ $product->nameproduct }}">
                                </a>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{ $product->nameproduct }}</h5>
                                    <p class="text-warning">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#produkTerbaruCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#produkTerbaruCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Produk Terbaru -->
<div class="container py-5" id="produk">
    <h2 class="mb-4 text-center fw-bold text-primary">
        @if (!empty($query))
            Hasil Pencarian untuk "{{ $query }}"
        @else
            Produk Terbaru
        @endif
    </h2>

    <div class="row g-4">
        @forelse ($products as $product)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded">
                    <!-- Gunakan fallback image jika tidak ada gambar -->
                    <img src="{{ asset('storage/'.$product->image ?: 'images/default.jpg') }}" class="rounded-top" style="width: 100%; height: 220px; object-fit: cover;" alt="{{ $product->nameproduct }}">
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <h5 class="card-title fw-bold">{{ $product->nameproduct }}</h5>
                        <span class="price-tag">{{ "Rp " . number_format($product->price,2,',','.') }}</span>
                        <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn btn-outline-primary w-100 fw-semibold">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>Tidak ada produk ditemukan untuk <strong>{{ $query }}</strong>.</p>
            </div>
        @endforelse
    </div>

    <!-- Produk Terlaris -->
@unless(isset($isSearch) && $isSearch)
<div class="container py-5" id="produk-terlaris">
    <h2 class="mb-4 text-center fw-semibold text-dark">🔥 Produk Terlaris</h2>

    <div class="row g-4">
        @forelse ($bestSellers as $product)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <img src="{{ asset('storage/'.$product->image ?: 'images/default.jpg') }}" 
                        class="img-fluid" 
                        style="height: 220px; object-fit: cover;" 
                        alt="{{ $product->nameproduct }}">

                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <h5 class="fw-semibold text-dark mb-2">{{ $product->nameproduct }}</h5>
                        <span class="price-tag">{{ "Rp " . number_format($product->price,2,',','.') }}</span>
                        
                        <div class="mt-2">
                            <span class="badge bg-light text-muted rounded-pill small px-3 py-1">
                                <i class="bi bi-fire text-danger me-1"></i> Terjual {{ $product->transactions_count }}x
                            </span>
                        </div>

                        <a href="{{ route('product.show', ['id' => $product->id]) }}" 
                            class="btn btn-outline-dark mt-3 w-100 rounded-pill fw-semibold">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada produk terlaris saat ini.</p>
            </div>
        @endforelse
    </div>
</div>
@endunless
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
