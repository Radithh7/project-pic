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
        .jumbotron {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
            padding: 4rem 2rem;
            border-radius: 0 0 1rem 1rem;
            margin-bottom: 3rem;
        }
        .card:hover {
            transform: scale(1.03);
            transition: 0.3s ease;
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
    </style>
</head>
<body>

    <!-- Banner -->
    <div class="jumbotron text-center shadow">
        <h1 class="display-5 fw-bold">Selamat Datang di <span class="text-warning">SPW Online</span>!</h1>
        <p class="lead">Temukan produk kebutuhan sekolah favoritmu dengan harga terjangkau.</p>
        <div class="container col-5 mt-3">
            <form action="{{ route('product.search') }}" method="GET" class="d-flex search-box">
                <input type="text" name="query" class="form-control" placeholder="Cari produk...">
                <button type="submit" class="btn btn-warning ms-2 fw-semibold d-flex align-items-center gap-1">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
        <a href="{{ route('product.showcategory') }}" class="btn btn-light btn-lg fw-semibold shadow-sm mt-4">
                Jelajahi Kategori
        </a>
    </div>

    <!-- Produk Terbaru -->
    <div class="container">
        <h2 class="mb-4 text-center fw-bold text-primary">
            @if (!empty($query))
                Hasil Pencarian untuk "{{ $query }}"
            @else
                Produk Terbaru
            @endif
        </h2>

        <!-- Daftar Produk -->
        <div class="row g-4">
            @forelse ($products as $product)
                <!-- Card Produk -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded">
                        <img src="{{ asset('storage/'.$product->image) }}" class="rounded-top" style="width: 100%; height: 220px; object-fit: cover;" alt="{{ $product->nameproduct }}">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
