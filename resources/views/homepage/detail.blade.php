<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg border-0 rounded">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded-start" alt="{{ $product->nameproduct }}">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h3 class="card-title fw-bold">{{ $product->nameproduct }}</h3>
                        <h4 class="text-primary">{{ "Rp " . number_format($product->price,2,',','.') }}</h4>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="text-muted">Kategori: <strong>{{ $product->category->category_name }}</strong></p>
                        <p class="text-muted">Stok: <strong>{{ $product->stock }}</strong></p>
                        
                        <a href="/" class="btn btn-secondary">Kembali</a>
                        <a href="#" class="btn btn-success">Beli Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
