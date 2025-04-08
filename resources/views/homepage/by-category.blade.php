<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .category-title {
            border-left: 5px solid #0d6efd;
            padding-left: 12px;
            margin-bottom: 1.5rem;
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
<div class="container py-5">
    <h2 class="mb-5 text-center fw-bold text-primary">Kategori Produk</h2>

    @foreach ($categories as $category)
        <div class="mb-5">
            <h3 class="fw-bold category-title">{{ $category->category_name }}</h3>
            <div class="row g-4 mt-2">
                @forelse ($category->products as $product)
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0 rounded h-100">
                            <img src="{{ asset('storage/'.$product->image) }}" class="rounded-top" style="width: 100%; height: 220px; object-fit: cover;" alt="{{ $product->nameproduct }}">
                            <div class="card-body text-center d-flex flex-column justify-content-between">
                                <h5 class="card-title fw-bold">{{ $product->nameproduct }}</h5>
                                <p class="price-badge mb-3">{{ "Rp " . number_format($product->price,2,',','.') }}</p>
                                <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn btn-outline-primary w-100 fw-semibold">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <p class="text-muted">Belum ada produk di kategori ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
