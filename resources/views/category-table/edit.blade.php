@extends('layouts.dashboard')

@section('title', 'Edit Kategori')

@section('content')
<hr>
<div class="container col-md-6 mt-4">
    <form action="{{ route('category-product.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="category_name" class="form-label">Nama Kategori</label>
            <input type="text" name="category_name" id="category_name" class="form-control" value="{{ $category->category_name }}" required>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Update Kategori</button>
            <a href="{{ route('category-product.index') }}" class="btn btn-warning ms-2"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
    </form>
</div>
@endsection