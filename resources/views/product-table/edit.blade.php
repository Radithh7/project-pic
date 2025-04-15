@extends('layouts.dashboard')

@section('title', 'Edit Produk')

@section('content')
<div class="container mt-4">
    <form action="{{ route('admin.dashboard.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <hr>
        <div class="row">
            {{-- Kolom Kiri --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nameproduct" class="form-label">Nama Produk</label>
                    <input type="text" name="nameproduct" class="form-control" value="{{ $product->nameproduct }}" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stok</label>
                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Upload Gambar Produk</label>
                    <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                    <img id="imagePreview" src="{{ asset('storage/images/' . $product->image) }}" class="img-fluid mt-2" style="width: 120px; height: 90px; object-fit: cover;">
                </div>
            </div>

            {{-- Kolom Kanan --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="categories_id" class="form-label">Kategori Produk</label>
                    <select name="categories_id" class="form-select" required>
                        <option disabled selected>Pilih Kategori</option>
                        @foreach($category as $cat)
                            <option value="{{ $cat->id }}" {{ $cat->id == $product->categories_id ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi Produk</label>
                    <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Produk</button>
        <a href="{{ route('admin.dashboard.index') }}" class="btn btn-warning">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');

    // Preview Gambar
    function previewImage(event) {
        const image = document.getElementById('imagePreview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                image.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
