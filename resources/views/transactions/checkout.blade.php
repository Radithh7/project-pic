<!-- resources/views/transactions/checkout.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="container py-5">
    <h2 class="mb-4">Checkout Pembayaran</h2>

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

    <div class="container mt-5">
    <h2>Checkout Produk</h2>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <input type="hidden" name="transaction_date" value="{{ now() }}">
        <input type="hidden" name="buyer_name" value="{{ Auth::user()->name }}">
        
        <input type="hidden" name="products[]" value="{{ $product->id }}">
        <input type="hidden" name="quantities[]" value="1">

        <div class="card mb-3">
            <div class="card-body">
                <h4>{{ $product->nameproduct }}</h4>
                <p>Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p>Stok: {{ $product->stock }}</p>
                <label>Jumlah:</label>
                <input type="number" name="quantities[]" value="1" min="1" max="{{ $product->stock }}" class="form-control" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
    </form>
</div>
</body>
</html>
