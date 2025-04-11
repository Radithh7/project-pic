<<<<<<< HEAD
@extends('layouts.dashboard')

@section('title', 'Data Produk')

@section('content')
    <a href="{{ route('dashboard.create') }}" class="btn btn-success mb-3"><i class="bi bi-plus-circle m-1"></i>Tambah Produk</a>

    <table class="table table-bordered bg-white">
        <thead class="table-success">
            <tr>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td><img src="{{ asset('storage/'.$product->image) }}" style="width: 50px;"></td>
                    <td>{{ $product->nameproduct }}</td>
                    <td>{{ $product->category->category_name }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ "Rp " . number_format($product->price, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('admin.dashboard.show', $product->id) }}" class="btn btn-sm btn-dark"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('admin.dashboard.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.dashboard.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection