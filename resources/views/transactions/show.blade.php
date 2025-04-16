<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .info-label {
            font-weight: 600;
            color: #6c757d;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .btn-back {
            border-radius: 50px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .badge-status {
            font-size: 0.85rem;
            padding: 0.45em 0.75em;
            border-radius: 50px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="mb-4 text-center">
            <h3 class="fw-bold text-primary"><i class="bi bi-receipt-cutoff me-2"></i>Detail Transaksi</h3>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <!-- Kartu informasi transaksi -->
        <div class="card mb-4 p-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <div><span class="info-label">ID Transaksi:</span> #{{ $transaction->id }}</div>
                    <div><span class="info-label">Tanggal:</span> {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y H:i') }}</div>
                    <div><span class="info-label">Nama Pembeli:</span> {{ $transaction->buyer_name }}</div>
                </div>
                <div class="col-md-6">
                    <div>
                        <span class="info-label">Status:</span>
                        @php
                            $status = strtolower($transaction->status);
                            $statusClass = match($status) {
                                'selesai' => 'bg-success',
                                'gagal' => 'bg-danger',
                                default => 'bg-warning text-dark'
                            };
                        @endphp
                        <span class="badge badge-status {{ $statusClass }}">{{ ucfirst($transaction->status) }}</span>
                    </div>
                    <div><span class="info-label">Metode Pembayaran:</span> <i class="bi bi-credit-card-2-front me-1"></i>{{ ucfirst($transaction->payment_method) }}</div>
                    <div><span class="info-label">Total:</span> <span class="text-success fw-bold">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span></div>
                </div>
            </div>
        </div>

        <!-- Tabel produk -->
        <h5 class="mb-3 fw-semibold">Item dalam Transaksi</h5>
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-hover align-middle bg-white shadow-sm">
                <thead class="table-light text-center">
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->items as $item)
                        <tr>
                            <td>{{ $item->product->nameproduct }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="text-success">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tombol kembali -->
        <div class="text-center">
            <a href="{{ route('transactions.index') }}" class="btn btn-outline-primary btn-back">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Daftar Transaksi
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
