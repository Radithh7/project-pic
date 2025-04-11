<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            height: 100vh;
            position: fixed;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #34495e;
        }
        .content {
            margin-left: 250px;
            padding: 30px;
            flex-grow: 1;
            background-color: #f4f6f9;
            min-height: 100vh;
        }
    </style>
    @yield('head') {{-- Optional untuk tambahan CSS di halaman --}}
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center mb-4">Dashboard</h4>
        <a href="{{ route('dashboard.index') }}"><i class="bi bi-box-seam me-2"></i> Produk</a>
        <a href="{{ route('category-product.index') }}"><i class="bi bi-tags me-2"></i> Kategori</a>
    </div>

    <div class="content">
        <h3 class="mb-4">@yield('title')</h3>
        @yield('content')
    </div>

    {{-- Script dasar Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts') {{-- Tambahan JS halaman --}}
</body>
</html>
