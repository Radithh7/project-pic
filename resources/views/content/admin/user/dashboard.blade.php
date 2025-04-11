<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f9fafb;
            margin: 0;
        }
        header {
            background-color: #2563eb;
            color: white;
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
            box-shadow: 0 0 8px rgba(0,0,0,0.08);
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
    <h2>Dashboard User</h2>
    <div>
        <span>Selamat datang, {{ auth()->user()->name }}</span>
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
        <h3>Produk Terbaru</h3>
        <p><a href="#">Lihat Produk</a></p>
    </div>
    <div class="card">
        <h3>Kategori</h3>
        <p><a href="#">Lihat Berdasarkan Kategori</a></p>
    </div>
</div>

</body>
</html>
