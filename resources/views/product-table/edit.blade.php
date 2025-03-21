<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update - Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <form action="{{ route('dashboard.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row justify-content-center">
            <h2 class="text-center my-3">Update Produk</h2>
            <hr>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nameproduct" class="form-label">Nama Produk</label>
                        <input type="text" name="nameproduct" id="nameproduct" class="form-control" value="{{ $product->nameproduct }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok</label>
                        <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Gambar Produk</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                        <img id="imagePreview" src="{{ asset('storage/images/' . $product->image) }}" alt="Preview Gambar" class="img-fluid mt-3" style="width: 120px; height: 90px; object-fit: cover;">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                            <label for="categories_id" class="form-label">Kategori Produk</label>
                            <select name="categories_id" id="categories_id" class="form-select" required>
                                <option disabled>Pilih Kategori</option>
                                @foreach($category as $cat)
                                    <option value="{{$cat->id}}" {{ $cat->id == $product->categories_id ? 'selected' : '' }}>{{$cat->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Produk</label>
                        <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Produk</button>
        </form>
    </div>  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>