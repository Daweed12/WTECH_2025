@extends('layout.app')

@php
    /* Na Str::upper() */
    use Illuminate\Support\Str;
@endphp

{{-- vlastné CSS + JS cez Vite --}}
@vite([
    'resources/css/products.css',
    'resources/js/slider.js',
])

@section('contents')

    {{-- ================= VÝSLEDKY VYHĽADÁVANIA ================= --}}
    @if (!empty($query))
        <h4 class="text-center my-4">
            Results for “{{ $query }}” ({{ $products->total() }})
        </h4>
    @endif

    {{-- ================= SORT + FILTER BAR ================= --}}
    <div class="sort-filter-container">
        <a href="javascript:void(0)" id="openFilter" class="btn-filter">FILTER</a>

        <select class="order-by">
            <option value="popularity">ORDER BY POPULARITY</option>
            <option value="price-asc">PRICE ↑</option>
            <option value="price-desc">PRICE ↓</option>
        </select>
    </div>

    {{-- ================= PRODUCTS GRID ===================== --}}
    <div class="products-wrapper">
        @foreach ($products as $product)
            @php
                $first  = $product->images[0]->url ?? null;
                $second = $product->images[1]->url ?? null;   // môže chýbať
            @endphp

            <a href="{{ route('products.show', $product) }}"
               class="product-container text-decoration-none text-dark">

                {{-- ===== Obrázok produktu ===== --}}
                <div class="image-wrapper">
                    @if ($first)
                        <img src="{{ asset('storage/' . $first) }}"
                             class="img-front"
                             alt="{{ $product->title }}">
                    @endif

                    @if ($second)
                        <img src="{{ asset('storage/' . $second) }}"
                             class="img-back"
                             alt="{{ $product->title }} alt view">
                    @endif
                </div>

                {{-- ===== Názov a cena ===== --}}
                <div class="product-title">
                    {{ Str::upper($product->title) }}
                </div>

                <div class="product-price">
                    €{{ number_format($product->price, 2, ',', ' ') }}
                </div>
            </a>
        @endforeach
    </div>

    {{-- ================= PAGINATION ======================== --}}
    <div class="d-flex justify-content-center">
        {{ $products->links('vendor.pagination.bootstrap-5') }}
    </div>

    {{-- ================= FILTER SIDEBAR ==================== --}}
    <div id="filterSidebar" class="filter-sidebar">
        {{-- ----- Hlavička ----- --}}
        <div class="filter-header">
            <h4>Filter</h4>
            <span class="close-filter" id="closeFilter">&times;</span>
        </div>

        {{-- ----- Príkladové filtre (doplň si vlastné) ----- --}}
        <div class="filter-body">
            {{-- PRICE RANGE --}}
            <div class="filter-group">
                <h5>Price</h5>
                <label><input type="checkbox"> 0 € – 29 €</label><br>
                <label><input type="checkbox"> 30 € – 49 €</label><br>
                <label><input type="checkbox"> 50 €+</label>
            </div>

            {{-- CATEGORY --}}
            <div class="filter-group">
                <h5>Category</h5>
                <label><input type="checkbox"> Rings</label><br>
                <label><input type="checkbox"> Necklaces</label><br>
                <label><input type="checkbox"> Bracelets</label>
            </div>

            <button class="btn-apply-filter">Apply Filters</button>
        </div>
    </div>

    {{-- ================= OVERLAY PRE SIDEBAR =============== --}}
    <div id="overlay"></div>
@endsection
