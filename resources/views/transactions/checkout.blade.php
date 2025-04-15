<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f8;
            font-family: 'Segoe UI', sans-serif;
        }

        .checkout-container {
            max-width: 900px;
            margin: auto;
        }

        .product-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
            background: #fff;
        }

        .product-img {
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-img:hover {
            transform: scale(1.05);
        }

        .btn-checkout {
            font-size: 1.1rem;
            font-weight: 500;
        }

        .card-body label {
            font-weight: 500;
        }

        .form-control, .form-select {
            border-radius: 8px;
        }

        .back-link {
            text-decoration: none;
            color: #6c757d;
        }

        .back-link:hover {
            color: #495057;
        }
    </style>
</head>
<body>
    <div class="container py-5 checkout-container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">🛒 Checkout Pembayaran</h2>
        </div>

        {{-- Alert --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <input type="hidden" name="transaction_date" value="{{ now() }}">
            <input type="hidden" name="buyer_name" value="{{ Auth::user()->name }}">
            <input type="hidden" name="products[]" value="{{ $product->id }}">

            <div class="card product-card mb-4">
                <div class="row g-0">
                    <div class="col-md-5">
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->nameproduct }}" 
                             class="img-fluid w-100 h-100 product-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->nameproduct }}</h4>
                            <p class="text-muted mb-2">Harga: <strong class="text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>
                            <p class="mb-4">Stok Tersedia: <strong>{{ $product->stock }}</strong></p>

                            <div class="mb-3">
                                <label for="quantity">Jumlah:</label>
                                <input type="number" name="quantities[]" id="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Metode Pembayaran:</label>
                                <select name="payment_method" id="payment_method" class="form-control" required>
                                    <option value="cash">Cash</option>
                                    <option value="gopay">GoPay</option>
                                    <option value="dana">DANA</option>
                                    <option value="ovo">OVO</option>
                                    <option value="shopeepay">ShopeePay</option>
                                </select>
                            </div>


                            <button type="submit" class="btn btn-primary btn-checkout w-100">Bayar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ url()->previous() }}" class="back-link">← Kembali Belanja</a>
            </div>
        </form>
    </div>
</body>
</html>
