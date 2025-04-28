<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <h3>Memproses pembayaran...</h3>

    <script type="text/javascript">
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                window.location.href = "/payment-success?order_id={{ $orderId }}&product_id={{ $product->id }}&quantity={{ $quantity }}&total={{ $total }}";
            },
            onPending: function(result) {
                alert("Pembayaran pending. Silakan selesaikan pembayaran.");
            },
            onError: function(result) {
                alert("Pembayaran gagal: " + result.status_message);
            },
            onClose: function() {
                alert('Anda menutup tanpa menyelesaikan pembayaran');
            }
        });
    </script>
</body>
</html>
