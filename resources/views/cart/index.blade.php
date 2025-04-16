<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - SPW Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .cart-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .cart-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 0.5rem;
        }
        .cart-remove {
            border: none;
            background: none;
            color: #dc3545;
        }
        .cart-remove:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white py-3">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">SPW Online</a>

        <div class="d-flex align-items-center gap-3 ms-auto">
            <a href="{{ route('user.dashboard.index') }}" class="btn btn-outline-secondary rounded-pill">Kembali Belanja</a>
        </div>
    </div>
</nav>

<!-- Cart Content -->
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold text-primary">Keranjang Belanja</h2>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if (count($cart) > 0)
        <div class="list-group mb-4">
            @php $grandTotal = 0; @endphp
            @foreach ($cart as $id => $item)
                @php $total = $item['price'] * $item['quantity']; $grandTotal += $total; @endphp
                <div class="list-group-item bg-white cart-card mb-3 p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('storage/'.$item['image']) }}" class="cart-img" alt="{{ $item['name'] }}">
                        <div>
                            <h5 class="mb-1 fw-semibold">{{ $item['name'] }}</h5>
                            <small class="text-muted">Jumlah: {{ $item['quantity'] }}</small><br>
                            <small class="text-muted">Harga: Rp {{ number_format($item['price'], 0, ',', '.') }}</small>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold text-primary">Rp {{ number_format($total, 0, ',', '.') }}</div>
                        <form action="{{ route('cart.remove') }}" method="POST" class="mt-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $id }}">
                            <button type="submit" class="cart-remove"><i class="bi bi-trash3"></i> Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-end fw-bold fs-5 mb-4">
            Total: <span class="text-success">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
        </div>

        <div class="text-end">
            <a href="{{ route('transactions.index') }}" class="btn btn-success px-4 py-2 rounded-pill">Lanjut ke Checkout</a>
        </div>
    @else
        <div class="text-center text-muted fs-5">
            <i class="bi bi-cart-x display-4 d-block mb-3"></i>
            Keranjang masih kosong. Yuk belanja dulu!
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
