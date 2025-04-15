<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h2 class="text-center mb-4">Detail Transaksi</h2>

        <!-- Jika ada pesan sukses -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Menampilkan informasi transaksi -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Transaksi #{{ $transaction->id }}</h5>
                <p><strong>Tanggal:</strong> {{ $transaction->transaction_date }}</p>
                <p><strong>Nama Pembeli:</strong> {{ $transaction->buyer_name }}</p>
                <p><strong>Total Pembayaran:</strong> Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
                <p><strong>Status:</strong> {{ ucfirst($transaction->status) }}</p>
                <p><strong>Metode Pembayaran:</strong> {{ ucfirst($transaction->payment_method) }}</p>
            </div>
        </div>

        <h4 class="mb-4">Detail Item Transaksi</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction->items as $item)
                    <tr>
                        <td>{{ $item->product->nameproduct }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Link untuk kembali ke halaman transaksi -->
        <div class="text-center">
            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali ke Daftar Transaksi</a>
        </div>
    </div>
</body>
</html>
