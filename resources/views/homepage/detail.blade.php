<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - {{ $product->nameproduct }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            background-color: #fff;
            border-radius: 1rem;
        }
        .price-tag {
            background-color: #e7f1ff;
            color: #0d6efd;
            font-weight: bold;
            padding: 0.4rem 1.2rem;
            border-radius: 999px;
            display: inline-block;
            font-size: 1.2rem;
        }
        .stock-info {
            font-size: 0.95rem;
            color: #6c757d;
        }
        .btn-custom {
            min-width: 140px;
        }
        .product-img {
            max-height: 400px;
            object-fit: cover;
            border-radius: 1rem;
        }
        .action-btns form {
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="card shadow-sm border-0 p-4">
        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center">
                <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid product-img" alt="{{ $product->nameproduct }}">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h2 class="fw-bold text-dark">{{ $product->nameproduct }}</h2>
                    <span class="price-tag mb-3">
                        {{ 'Rp ' . number_format($product->price, 2, ',', '.') }}
                    </span>

                    <p class="text-muted mb-3">{{ $product->description }}</p>

                    <p class="mb-1 stock-info">
                        <i class="bi bi-tags-fill text-primary me-1"></i>
                        Kategori: <strong>{{ $product->category->category_name }}</strong>
                    </p>
                    <p class="mb-4 stock-info">
                        <i class="bi bi-box-seam text-success me-1"></i>
                        Stok tersedia: <strong>{{ $product->stock }}</strong>
                    </p>

                    <div class="d-flex flex-column flex-md-row gap-2 action-btns">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                        </a>

                        @if ($product->stock > 0)
                        <form action="{{ route('cart.add') }}" method="POST" class="d-flex align-items-center gap-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" min="1" max="{{ $product->stock }}" value="1" class="form-control form-control-sm" style="width: 70px;">
                            <button type="submit" class="btn btn-outline-primary btn-sm">Keranjang</button>
                        </form>

                        <form action="{{ route('transactions.store') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="transaction_date" value="{{ now()->toDateString() }}">
                            <input type="hidden" name="buyer_name" value="{{ Auth::user()->name }}">
                            <input type="hidden" name="products[]" value="{{ $product->id }}">
                            <input type="hidden" name="quantities[]" value="1">
                            <input type="hidden" name="payment_method" value="gopay">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="bi bi-bag-check me-1"></i> Beli Sekarang
                            </button>
                        </form>

                        @else
                            <button class="btn btn-secondary btn-sm" disabled>Stok Habis</button>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
