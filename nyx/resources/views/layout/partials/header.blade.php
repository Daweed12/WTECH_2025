<!-- Top bar with sign in / sign up or welcome message -->
<div class="container-fluid bg-light py-2 top-bar">
    <div class="container d-flex justify-content-end align-items-center">
        @auth
            <span class="small">
                Welcome, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}!
            </span>
        @else
            <a href="{{ route('account') }}" class="small sign-in-link">
                Sign In / Sign Up
            </a>
        @endauth
    </div>
</div>

<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container d-flex w-100 justify-content-between align-items-center">

        <!-- Hamburger menu for categories -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#categoriesMenu" aria-controls="categoriesMenu"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand logo -->
        <a href="{{ route('home') }}" class="navbar-brand"><b>NYX</b></a>

        <!-- Category navigation links -->
        <div class="collapse navbar-collapse" id="categoriesMenu">
            <ul class="navbar-nav d-flex justify-content-start">
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">SHOP ALL</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index', ['category' => 'necklaces']) }}" class="nav-link">NECKLACES</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index', ['category' => 'rings']) }}" class="nav-link">RINGS</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index', ['category' => 'earrings']) }}" class="nav-link">EARRINGS</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index', ['category' => 'bracelets']) }}" class="nav-link">BRACELETS</a>
                </li>
            </ul>
        </div>

        <!-- Header icons (search, wishlist, account, cart) -->
        <div class="d-flex align-items-center ms-auto">

            {{-- ADMIN icon – visible only to users with role = 1 --}}
            @auth
                @if(Auth::user()->role === 1)
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link me-2"
                       title="Admin Panel">
                        <i class="fa-solid fa-user-gear"></i>
                    </a>
                @endif
            @endauth

            <!-- Search icon -->
            <a href="#" class="nav-link me-2" data-bs-toggle="collapse"
               data-bs-target="#navbarSearch" aria-expanded="false" aria-controls="navbarSearch">
                <i class="fa-solid fa-magnifying-glass"></i>
            </a>

            <!-- Wishlist icon -->
            <a href="#" class="nav-link me-2">
                <i class="fa-solid fa-heart"></i>
            </a>

            <!-- Account icon -->
            <a href="{{ route('account') }}" class="nav-link me-2">
                <i class="fa-solid fa-user"></i>
            </a>

            <!-- Cart icon -->
            <a href="#" class="nav-link position-relative">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
        </div>
    </div>
</nav>

<!-- Collapsible search bar -->
<div class="collapse search-bar" id="navbarSearch">
    <div class="container">
        <form action="{{ route('products.search') }}" method="GET"
              class="d-flex my-2" role="search">
            <input name="q"
                   class="form-control"
                   type="search"
                   placeholder="Search products..."
                   value="{{ request('q') }}"
                   aria-label="Search">
        </form>
    </div>
</div>
