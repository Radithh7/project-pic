<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

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

        return redirect()->back()->withErrors(['msg' => 'Produk tidak ditemukan.']);
    }

    public function store(Request $request)
    {
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

        $orderId = 'TRX-' . time() . '-' . rand(100, 999);

        $transaction = Transaction::create([
            'order_id'         => $orderId,
            'transaction_date' => $request->transaction_date,
            'buyer_name'       => $request->buyer_name,
            'total'            => $total,
            'status'           => 'pending',
            'user_id'          => Auth::id(),
            'payment_method'   => $request->payment_method,
        ]);

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email'      => Auth::user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        $transaction->snap_token = $snapToken;
        $transaction->save();

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

        return view('transactions.payment', [
            'transaction' => $transaction,
            'snapToken'   => $snapToken
        ]);
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('items.product');
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

    public function handleCallback(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $notif = new Notification();
        $status = $notif->transaction_status;
        $orderId = $notif->order_id;

        $transaction = Transaction::where('order_id', $orderId)->first();

        if (!$transaction && in_array($status, ['capture', 'settlement'])) {
            $userId = $notif->custom_fields->user_id ?? null;
            $productId = $notif->custom_fields->product_id ?? null;
            $quantity = $notif->custom_fields->quantity ?? 1;

            $product = Product::find($productId);
            $subtotal = $product->price * $quantity;

            $transaction = Transaction::create([
                'order_id'         => $orderId,
                'transaction_date' => now(),
                'buyer_name'       => $userId ? User::find($userId)->name : 'Unknown',
                'total'            => $subtotal,
                'status'           => 'paid',
                'user_id'          => $userId,
                'payment_method'   => 'gopay',
            ]);

            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id'     => $productId,
                'quantity'       => $quantity,
                'price'          => $product->price,
                'subtotal'       => $subtotal,
            ]);

            Product::where('id', $productId)->decrement('stock', $quantity);
        }

        return response()->json(['status' => 'callback received']);
    }

    public function getSnapToken(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $orderId = 'TRX-' . time() . '-' . rand(1000, 9999);

        session(['pending_order_id' => $orderId]);

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $product->price * $request->quantity,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email'      => Auth::user()->email,
            ],
            'item_details' => [
                [
                    'id'       => $product->id,
                    'price'    => $product->price,
                    'quantity' => $request->quantity,
                    'name'     => $product->nameproduct
                ]
            ],
            'callbacks' => [
                'finish' => route('transactions.index')
            ],
            'custom_fields' => [
                'user_id'    => Auth::id(),
                'product_id' => $product->id,
                'quantity'   => $request->quantity
            ]
        ];

        $snapToken = Snap::getSnapToken($params);
        return response()->json(['snap_token' => $snapToken]);
    }
    public function buyWithCash(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;

        if ($product->stock < $quantity) {
            return back()->withErrors(['msg' => 'Stok tidak mencukupi.']);
        }

        $subtotal = $product->price * $quantity;
        $orderId = 'CASH-' . time() . '-' . rand(100, 999);

        $transaction = Transaction::create([
            'order_id' => $orderId,
            'transaction_date' => now(),
            'buyer_name' => Auth::user()->name,
            'total' => $subtotal,
            'status' => 'paid', // langsung dianggap berhasil
            'user_id' => Auth::id(),
            'payment_method' => 'cash',
        ]);

        TransactionItem::create([
            'transaction_id' => $transaction->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price,
            'subtotal' => $subtotal,
        ]);

        $product->decrement('stock', $quantity);

        return redirect()->route('transactions.index')->with('success', 'Transaksi cash berhasil!');
    }
}
