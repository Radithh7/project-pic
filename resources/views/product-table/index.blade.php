<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table #06</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            margin: 50px auto;
            max-width: 900px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead {
            background-color: #94a58b;
            color: white;
        }
        tbody tr {
            border-bottom: 1px solid #ddd;
        }
        tbody td {
            padding: 10px;
            vertical-align: middle;
        }
        .product-info {
            display: flex;
            align-items: center;
        }
        .product-info img {
            width: 50px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h3 class="text-center">Table Produk</h3>
        <p class="text-center">Product List</p>
        <div class="card-body">
            <a href="{{ route('dashboard.create') }}" class="btn btn-md btn-success mb-3"><i class="bi bi-plus-circle m-1"></i>TAMBAH PRODUK</a>
            <a href="{{ route('category-product.index') }}" class="btn btn-md btn-success mb-3"><i class="bi bi-table m-1"></i>KATEGORI</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td><img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->nameproduct }}" style="width: 50px;"></td>
                        <td>{{ $product->nameproduct }}</td>
                        <td>{{ $product->category->category_name }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ "Rp " . number_format($product->price,2,',','.') }}</td>
                        <td>
                            <a href="{{ route('dashboard.show', $product->id) }}" class="btn btn-sm btn-dark" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('dashboard.edit', $product->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('dashboard.destroy', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>
