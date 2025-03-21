<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Banner -->
    <div class="jumbotron p-5 mb-4 text-white rounded-3" style="background: linear-gradient(135deg, #007bff, #6610f2);">
        <h1 class="display-4 fw-bold">Selamat Datang di SPW Online!</h1>
        <p class="lead">Temukan berbagai produk berkualitas dengan harga terbaik.</p>
        <a href="{{ route('category-product.index') }}" class="btn btn-light btn-lg shadow">Jelajahi Kategori</a>
    </div>

    <div class="container">
        <!-- Produk Terbaru -->
        <h2 class="mb-4 text-center fw-bold">Produk Terbaru</h2>
        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded">
                        <img src="{{ asset('storage/'.$product->image) }}" class="rounded-top" style="width: 100%; height: 200px; object-fit: cover;" alt="{{ $product->nameproduct }}">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">{{ $product->nameproduct }}</h5>
                            <p class="card-text text-primary fw-semibold">{{ "Rp " . number_format($product->price,2,',','.') }}</p>
                            <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn btn-success w-100 fw-bold">
                                Detail Produk
                            </a>                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
