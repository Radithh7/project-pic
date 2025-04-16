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
    </style>
</head>
<body class="bg-light-gray">
<nav class="navbar navbar-expand-lg bg-white py-3">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="#">SPW Online</a>

        <form action="{{ route('product.search') }}" method="GET" class="d-flex mx-auto w-50">
            <input name="query" class="form-control search-box px-4" type="search" placeholder="Cari produk...">
            <button class="btn btn-warning btn-rounded ms-2 px-4"><i class="bi bi-search"></i></button>
        </form>

        <div class="d-flex align-items-center gap-3">
            @auth
                <div class="dropdown">
                    <a class="text-dark dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle fs-5"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('transactions.index') }}">Transaksi</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-dark"><i class="bi bi-box-arrow-in-right fs-5"></i></a>
            @endauth
            <a href="{{ route('cart.index') }}" class="btn position-relative">
                <i class="bi bi-cart fs-5"></i>
                @if($totalCartItems > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $totalCartItems }}
                    </span>
                @endif
            </a>
        </div>
    </div>
</nav>

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
    <div class="row g-4">
        @forelse ($products as $product)
            <div class="col-md-4">
                <div class="card product-card border-0 rounded-4 overflow-hidden h-100">
                    <img src="{{ asset('storage/'.$product->image ?: 'images/default.jpg') }}" class="img-fluid" style="height: 220px; object-fit: cover;">
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="fw-bold text-truncate" title="{{ $product->nameproduct }}">{{ $product->nameproduct }}</h5>
                        <span class="price-badge mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn btn-outline-primary btn-rounded mt-auto">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>Tidak ada produk ditemukan untuk <strong>{{ $query }}</strong>.</p>
            </div>
        @endforelse
    </div>

    @unless(isset($isSearch) && $isSearch)
    <div class="py-5" id="produk-terlaris">
        <h2 class="mb-4 text-center fw-semibold text-dark">Produk Terlaris</h2>
        <div class="row g-4">
            @forelse ($bestSellers as $product)
                <div class="col-md-4">
                    <div class="card product-card border-0 rounded-4 overflow-hidden h-100">
                        <img src="{{ asset('storage/'.$product->image ?: 'images/default.jpg') }}" class="img-fluid" style="height: 220px; object-fit: cover;">
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="fw-semibold text-dark mb-2">{{ $product->nameproduct }}</h5>
                            <span class="price-badge">Rp {{ number_format($product->price,2,',','.') }}</span>
                            <span class="badge bg-light text-muted rounded-pill small px-3 py-1 mt-2">Terjual {{ $product->transactions_count }}x</span>
                            <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn btn-outline-dark btn-rounded mt-3">Lihat Detail</a>
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