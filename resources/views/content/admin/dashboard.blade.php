<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f5f5f5;
            margin: 0;
        }
        header {
            background-color: #1f2937;
            color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .container {
            padding: 2rem;
        }
        .card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            margin-bottom: 1rem;
        }
        a {
            color: white;
            text-decoration: none;
            margin-left: 1rem;
        }
    </style>
</head>
<body>

<header>
    <h2>Dashboard Admin</h2>
    <div>
        <span>Halo, {{ auth()->user()->name }} (admin)</span>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           Logout
        </a>
    </div>
</header>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<div class="container">
    <div class="card">
        <h3>Manajemen Produk</h3>
        <p><a href="#">Tambah / Edit Produk</a></p>
    </div>
    <div class="card">
        <h3>Manajemen User</h3>
        <p><a href="#">Lihat Data Pengguna</a></p>
    </div>
</div>

</body>
</html>
