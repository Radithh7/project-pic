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
            font-size: 0.9rem;
            background-color: #e0f3ff;
            color: #0d6efd;
            padding: 0.3rem 0.6rem;
            border-radius: 999px;
            display: inline-block;
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
<body>

@include('layouts.navbar')

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
                <div class="bg-white p-3 rounded shadow-sm scroll-wrapper">
                    <div class="d-flex flex-nowrap gap-3">
                        @php
                            $productList = isset($products) ? $products : collect();
                            if (!isset($products)) {
                                foreach ($categories as $category) {
                                    $productList = $productList->merge($category->products);
                                }
                            }
                        @endphp

                        @forelse ($productList as $product)
                            <div class="card shadow-sm border-0" style="min-width: 200px; max-width: 200px; flex: 0 0 auto;">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->nameproduct }}" style="height:160px; object-fit:cover;">
                                    <span class="badge bg-primary position-absolute top-0 start-0 m-2">Baru</span>
                                    @if($product->discount)
                                        <span class="badge bg-danger position-absolute top-0 end-0 m-2">-{{ $product->discount }}%</span>
                                    @endif
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
                            <p class="text-muted ms-3">Tidak ada produk yang ditemukan.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>
