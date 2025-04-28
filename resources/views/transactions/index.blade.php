<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Transaksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background: #f8f9fa;
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
        .table thead {
            background-color: #f1f3f5;
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
        .badge-status {
            font-size: 0.85rem;
            padding: 0.4em 0.7em;
            border-radius: 50px;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .btn-sm {
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container py-5">
        <h2 class="fw-bold text-primary mb-4"><i class="bi bi-list-check me-2"></i>Riwayat Transaksi</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($transactions->isEmpty())
            <div class="no-transactions">
                <i class="bi bi-receipt"></i>
                <h5>Belum ada transaksi yang dilakukan.</h5>
                <p>Yuk mulai belanja sekarang!</p>
                <a href="{{ url('/') }}" class="btn btn-outline-primary mt-3">
                    <i class="bi bi-cart-plus me-1"></i> Belanja Sekarang
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-bordered bg-white shadow-sm">
                    <thead class="text-center text-secondary">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td class="text-center fw-medium">{{ $transaction->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y H:i') }}</td>
                                <td>
                                    <i class="bi bi-credit-card me-1"></i> {{ ucfirst($transaction->payment_method) }}
                                </td>
                                <td class="text-center">
                                    @php
                                        $status = strtolower($transaction->status);
                                        $statusClass = match($status) {
                                            'settlement', 'success', 'paid' => 'bg-success',
                                            'pending' => 'bg-warning text-dark',
                                            'cancel', 'expire', 'deny', 'failed' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge badge-status {{ $statusClass }}">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td class="text-end text-success">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('transactions.show', $transaction) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye-fill me-1"></i>Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
