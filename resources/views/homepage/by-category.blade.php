<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produk - Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    <h2 class="mb-5 text-center fw-bold">Kategori Produk</h2>

    @foreach ($categories as $category)
        <div class="mb-5">
            <h3 class="fw-bold">{{ $category->name }}</h3>
            <div class="row g-4 mt-2">
                @forelse ($category->products as $product)
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
                @empty
                    <p class="text-muted">Belum ada produk di kategori ini.</p>
                @endforelse
            </div>
        </div>
    @endforeach
</div>
</body>
</html>