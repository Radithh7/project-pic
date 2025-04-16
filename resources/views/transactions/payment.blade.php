<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
    <style>
        body {
            background-color: #f4f6f8;
            font-family: 'Segoe UI', sans-serif;
        }

        .payment-container {
            max-width: 600px;
            margin: 60px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
            padding: 30px;
            text-align: center;
        }

        .btn-pay {
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 8px;
        }

        .icon-circle {
            font-size: 2.5rem;
            color: #0d6efd;
            margin-bottom: 20px;
        }

        .amount {
            font-size: 1.8rem;
            font-weight: bold;
            color: #198754;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="payment-container">
            <div class="icon-circle">
                <i class="bi bi-credit-card"></i>
            </div>
            <h2 class="text-primary fw-bold mb-3">Konfirmasi Pembayaran</h2>
            <p class="text-muted">Total yang harus dibayar:</p>
            <div class="amount mb-4">Rp {{ number_format($transaction->total, 0, ',', '.') }}</div>

            <button id="pay-button" class="btn btn-primary btn-pay">
                <i class="bi bi-cash-coin me-1"></i> Bayar Sekarang
            </button>

            <div class="mt-4">
                <a href="{{ route('transactions.index') }}" class="text-decoration-none text-muted">
                    <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke daftar transaksi
                </a>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    window.location.href = "{{ route('transactions.index') }}";
                },
                onPending: function(result) {
                    window.location.href = "{{ route('transactions.index') }}";
                },
                onError: function(result) {
                    alert("Terjadi kesalahan saat pembayaran.");
                    console.error(result);
                },
                onClose: function() {
                    alert("Anda menutup jendela pembayaran.");
                }
            });
        });
    </script>
</body>
</html>
