<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halaman Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card:hover {
            transform: scale(1.02);
            transition: all 0.3s ease-in-out;
        }
        .price-badge {
            font-size: 1rem;
            background-color: #e0f3ff;
            color: #0d6efd;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="container-fluid py-4 bg-light">
    <div class="container">
        <h2 class="fw-bold mb-4 text-primary">Kategori Produk</h2>
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="bg-white p-3 rounded shadow-sm">
                    <h5 class="fw-bold mb-3">Kategori</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('product-category.index') }}"
                            class="text-decoration-none d-block {{ request()->routeIs('product-category.index') ? 'fw-bold text-primary' : 'text-dark' }}">
                                Semua Produk
                            </a>
                        </li>
                        @foreach ($categories as $cat)
                            <li class="mb-2">
                                <a href="{{ route('product-category.filter', ['id' => $cat->id]) }}"
                                class="text-decoration-none d-block {{ request()->is('kategori/'.$cat->id) ? 'fw-bold text-primary' : 'text-dark' }}">
                                    {{ $cat->category_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <!-- Filter bar -->
                <div class="bg-white p-3 mb-3 rounded shadow-sm d-flex flex-wrap justify-content-between align-items-center">
                    <form action="{{ route('product-category.search') }}" method="GET" class="d-flex w-100 flex-wrap gap-2">
                        <input name="query" class="form-control rounded-pill px-4 w-75" type="search" placeholder="Cari produk..." value="{{ request('query') }}">
                        <button class="btn btn-warning rounded-pill px-4" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>

                <!-- Product list -->
                <div class="row g-4">
                    @php
                        $productList = isset($products) ? $products : collect();
                        if (!isset($products)) {
                            foreach ($categories as $category) {
                                $productList = $productList->merge($category->products);
                            }
                        }
                    @endphp

                    @forelse ($productList as $product)
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->nameproduct }}" style="height:220px; object-fit:cover;">
                                    <span class="badge bg-primary position-absolute top-0 start-0 m-2">Baru</span>
                                    @if($product->discount)
                                        <span class="badge bg-danger position-absolute top-0 end-0 m-2">-{{ $product->discount }}%</span>
                                    @endif
                                </div>
                                <div class="card-body text-center d-flex flex-column">
                                    <h5 class="card-title">{{ $product->nameproduct }}</h5>
                                    <p class="price-badge mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-primary w-100 mb-2">
                                        <i class="bi bi-eye"></i> Lihat Detail
                                    </a>

                                    <form action="#" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col">
                            <p class="text-muted">Tidak ada produk yang ditemukan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
