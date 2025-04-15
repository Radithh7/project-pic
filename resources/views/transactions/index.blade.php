<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Transaksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background: #f8f9fa;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .text-muted {
            font-size: 0.9rem;
        }

        .no-transactions {
            text-align: center;
            margin-top: 80px;
            color: #6c757d;
        }

        .no-transactions i {
            font-size: 48px;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h2 class="fw-bold text-primary mb-4"><i class="bi bi-clock-history me-2"></i>Daftar Transaksi</h2>

        {{-- Alert --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Daftar transaksi --}}
        @forelse ($transactions as $transaction)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">🧾 Transaksi #{{ $transaction->id }}</h5>
                    <p class="text-muted mb-1"><i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y H:i') }}</p>
                    <p class="mb-1"><i class="bi bi-credit-card-2-front"></i> Metode: <strong>{{ ucfirst($transaction->payment_method) }}</strong></p>
                    <p class="mb-1"><i class="bi bi-info-circle"></i> Status: <span class="badge bg-warning text-dark">{{ ucfirst($transaction->status) }}</span></p>
                    <p class="mb-3"><i class="bi bi-cash-coin"></i> Total: <strong class="text-success">Rp {{ number_format($transaction->total, 0, ',', '.') }}</strong></p>
                    <a href="{{ route('transactions.show', $transaction) }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-eye-fill me-1"></i> Lihat Detail
                    </a>
                </div>
            </div>
        @empty
            <div class="no-transactions">
                <i class="bi bi-receipt fs-1 mb-3"></i>
                <h5>Belum ada transaksi yang dilakukan.</h5>
                <p>Yuk mulai belanja sekarang!</p>
                <a href="{{ url('/') }}" class="btn btn-outline-primary mt-3">
                    <i class="bi bi-cart-plus fs-5 me-1"></i> Belanja Sekarang
                </a>
            </div>
        @endforelse
    </div>
</body>
</html>
