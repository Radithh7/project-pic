@extends('layouts.dashboard')

@section('title', 'Manajemen Transaksi')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle bg-white shadow-sm">
        <thead class="table-light">
            <tr>
                <th>Pembeli</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Ubah Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $tx)
                <tr>
                    <td>{{ $tx->buyer_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($tx->transaction_date)->format('d-m-Y H:i') }}</td>
                    <td>Rp {{ number_format($tx->total, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($tx->payment_method) }}</td>
                    <td><span class="badge bg-info text-dark">{{ ucfirst($tx->status) }}</span></td>
                    <td>
                        <form action="{{ route('admin.transactions.update', $tx->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="pending" {{ $tx->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="diproses" {{ $tx->status == 'diproses' ? 'selected' : '' }}>Sedang Dibuat</option>
                                <option value="siap" {{ $tx->status == 'siap' ? 'selected' : '' }}>Sudah Siap</option>
                                <option value="selesai" {{ $tx->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada transaksi</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection