<nav class="navbar navbar-expand-lg bg-white py-3 shadow-sm">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">SPW Online</a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Left Menu -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link fw-semibold text-primary">Home</a>
                </li>
                {{-- Tambah item nav lainnya jika perlu --}}
            </ul>

            <!-- Search Form -->
            <form action="{{ route('product.search') }}" method="GET" class="d-flex w-100 mx-lg-4 my-2 my-lg-0">
                <input name="query" class="form-control rounded-pill px-4 me-2" type="search" placeholder="Cari produk...">
                <button class="btn btn-warning rounded-pill px-4" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <!-- User & Cart (kanan) -->
        <div class="d-flex align-items-center gap-3 ms-lg-3 mt-2 mt-lg-0">
            @auth
                <div class="dropdown">
                    <a class="text-dark dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle fs-5 me-1"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('transactions.index') }}">Transaksi</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="dropdown-item text-danger" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-dark">
                    <i class="bi bi-box-arrow-in-right fs-5"></i>
                </a>
            @endauth

            <!-- Cart Icon -->
            <a href="{{ route('cart.index') }}" class="btn position-relative">
                <i class="bi bi-cart fs-5"></i>
                @if($totalCartItems > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $totalCartItems }}
                    </span>
                @endif
            </a>
        </div>
    </div>
</nav>
