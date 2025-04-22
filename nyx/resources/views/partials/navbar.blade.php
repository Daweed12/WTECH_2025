{{-- resources/views/partials/navbar.blade.php --}}
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container d-flex w-100 justify-content-between align-items-center">
        <!-- Hamburger (mobilné menu) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#categoriesMenu" aria-controls="categoriesMenu"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Logo -->
        <a href="{{ url('/') }}" class="navbar-brand"><b>NYX</b></a>

        <!-- Odkazy kategórií -->
        <div class="collapse navbar-collapse" id="categoriesMenu">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ url('/products') }}" class="nav-link">SHOP ALL</a></li>
                <li class="nav-item"><a href="#" class="nav-link">NECKLACES</a></li>
                <li class="nav-item"><a href="#" class="nav-link">RINGS</a></li>
                <li class="nav-item"><a href="#" class="nav-link">EARINGS</a></li>
                <li class="nav-item"><a href="#" class="nav-link">BRACELETS</a></li>
            </ul>
        </div>

        <!-- Ikony -->
        <div class="d-flex align-items-center ms-auto">
            <a href="#" class="nav-link me-2" data-bs-toggle="collapse" data-bs-target="#navbarSearch"
               aria-expanded="false" aria-controls="navbarSearch">
                <i class="fa-solid fa-magnifying-glass"></i>
            </a>
            <a href="#" class="nav-link me-2"><i class="fa-solid fa-heart"></i></a>
            <a href="{{ url('/account') }}" class="nav-link me-2"><i class="fa-solid fa-user"></i></a>
            <a href="{{ url('/cart') }}" class="nav-link position-relative"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
    </div>
</nav>

<!-- Collapsible search bar -->
<div class="collapse search-bar" id="navbarSearch">
    <div class="container">
        <form class="d-flex my-2">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        </form>
    </div>
</div>
