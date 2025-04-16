<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->orderBy('transaction_date', 'desc')->get();
        return view('transactions.index', compact('transactions'));
    }
    
    public function create(Request $request)
    {
        $productId = $request->product_id;

        if ($productId) {
            $product = Product::findOrFail($productId);
            return view('transactions.checkout', compact('product'));
        }

        // Tambahkan logic checkout dari keranjang kalau perlu (opsional)
        return redirect()->back()->withErrors(['msg' => 'Produk tidak ditemukan.']);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'transaction_date' => 'required|date',
            'buyer_name'       => 'required|string|max:255',
            'products'         => 'required|array',
            'products.*'       => 'exists:products,id',
            'quantities'       => 'required|array',
            'quantities.*'     => 'integer|min:1',
            'payment_method'   => 'required|string|in:cash,gopay,dana,ovo,shopeepay',
        ]);

        $total = 0;
        $items = [];

        // Cek stok & hitung total
        foreach ($request->products as $index => $productId) {
            $product = Product::findOrFail($productId);
            $quantity = $request->quantities[$index];

            if ($product->stock < $quantity) {
                return back()->withErrors(['msg' => "Stok produk {$product->nameproduct} tidak mencukupi!"]);
            }

            $subtotal = $product->price * $quantity;
            $total += $subtotal;

            $items[] = [
                'product_id' => $productId,
                'quantity'   => $quantity,
                'price'      => $product->price,
                'subtotal'   => $subtotal,
            ];
        }

        // Simpan transaksi utama
        $transaction = Transaction::create([
            'transaction_date' => $request->transaction_date,
            'buyer_name'       => $request->buyer_name,
            'total'            => $total,
            'status'           => 'pending',
            'user_id'          => Auth::id(),
            'payment_method'   => $request->payment_method,
        ]);

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Buat parameter transaksi untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'TRX-' . time() . '-' . rand(100, 999),
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        // Dapatkan Snap Token
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaction->snap_token = $snapToken;
        $transaction->save();

        // Simpan item transaksi & update stok
        foreach ($items as $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id'     => $item['product_id'],
                'quantity'       => $item['quantity'],
                'price'          => $item['price'],
                'subtotal'       => $item['subtotal'],
            ]);

            Product::where('id', $item['product_id'])->decrement('stock', $item['quantity']);
        }

        // Tampilkan halaman pembayaran Midtrans
        return view('transactions.payment', [
            'transaction' => $transaction,
            'snapToken'   => $snapToken
        ]);
    }

    public function show(Transaction $transaction)
    {
        // Ambil data transaksi bersama dengan item transaksi terkait
        $transaction->load('items.product'); // Memuat relasi dengan 'transaction_items' dan 'products'

        return view('transactions.show', compact('transaction'));
    }

    public function adminIndex()
    {
        $transactions = Transaction::with('user')->orderBy('transaction_date', 'desc')->get();
        return view('product-table.transaction', compact('transactions'));
    }

    public function updateStatus(Request $request, Transaction $transaction)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $transaction->update(['status' => $request->status]);

        return redirect()->route('admin.transactions')->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
