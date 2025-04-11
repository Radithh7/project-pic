@extends('layouts.dashboard')

@section('title', 'Tambah Kategori')

@section('content')
<hr>
<div class="container col-md-6 mt-4">
    <form action="{{ route('category-product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="category_name" class="form-label">Nama Kategori</label>
            <input type="text" name="category_name" id="category_name" class="form-control" required>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Kategori</button>
            <a href="{{ route('category-product.index') }}" class="btn btn-warning ms-2"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
    </form>
</div>
@endsection
