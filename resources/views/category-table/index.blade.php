<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            margin: 50px auto;
            max-width: 800px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        .category-buttons .btn {
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h3 class="text-center">Table Kategori</h3>
        <p class="text-center">Category List</p>

        <div class="card-body">
            <a href="{{ route('category-product.create') }}" class="btn btn-md btn-success mb-3">
                <i class="bi bi-plus-circle m-1"></i> TAMBAH KATEGORI
            </a>
            <a href="{{ route('dashboard.index') }}" class="btn btn-md btn-success mb-3"><i class="bi bi-table m-1"></i>PRODUK</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>
                                <a href="{{ route('category-product.edit', $category->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('category-product.destroy', $category->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
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
