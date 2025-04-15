@extends('layouts.dashboard')

@section('title', 'Tambah Produk')

@section('content')
<div class="container mt-4">
    <form action="{{ route('dashboard.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <hr>
        <div class="row">
            {{-- Kolom Kiri --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nameproduct" class="form-label">Nama Produk</label>
                    <input type="text" name="nameproduct" id="nameproduct" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="number" name="price" id="price" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stok</label>
                    <input type="number" name="stock" id="stock" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Upload Gambar Produk</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*" required onchange="previewImage(event)">
                    <img id="imagePreview" src="#" alt="Preview Gambar" class="img-fluid mt-2 d-none" style="width: 120px; height: 90px; object-fit: cover;">
                </div>
            </div>

            {{-- Kolom Kanan --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="categories_id" class="form-label">Kategori Produk</label>
                    <select name="categories_id" id="categories_id" class="form-select" required>
                        <option disabled selected>Pilih Kategori</option>
                        @foreach($category as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi Produk</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Produk</button>
            <a href="{{ route('admin.dashboard.index') }}" class="btn btn-warning ms-2"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');

    function previewImage(event) {
        const image = document.getElementById('imagePreview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                image.src = e.target.result;
                image.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            image.src = '#';
            image.classList.add('d-none');
        }
    }
</script>
@endsection
