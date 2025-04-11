@extends('layouts.dashboard')

@section('title', 'Data Kategori')

@section('content')
    <a href="{{ route('category-product.create') }}" class="btn btn-success mb-3"><i class="bi bi-plus-circle m-1"></i>Tambah Kategori</a>

    <table class="table table-bordered bg-white">
        <thead class="table-success">
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->category_name }}</td>
                    <td>
                        <a href="{{ route('category-product.edit', $cat->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('category-product.destroy', $cat->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
