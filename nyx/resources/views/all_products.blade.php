@extends('layout.app')

{{-- vlastné CSS + JS cez Vite --}}
@vite([
    'resources/css/products.css',
    'resources/js/slider.js',   {{-- ak slider používáš; inak odstráň --}}
])

@section('contents')
    {{-- ================= SORT + FILTER BAR ================= --}}
    <div class="sort-filter-container">
        <a href="javascript:void(0)" id="openFilter" class="btn-filter">FILTER</a>

        <select class="order-by">
            <option value="popularity">ORDER BY POPULARITY</option>
            <option value="price-asc">PRICE ↑</option>
            <option value="price-desc">PRICE ↓</option>
            <option value="new">NEWEST</option>
        </select>
    </div>

    {{-- ================= PRODUCTS GRID ===================== --}}
    <div class="products-wrapper">
        @foreach ($products as $product)
            @php
                $first  = $product->images[0]->url ?? null;
                $second = $product->images[1]->url ?? null;   // môže chýbať
            @endphp

            <a href="#"
               class="product-container text-decoration-none text-dark">
                <div class="image-wrapper">
                    {{-- front obrazok --}}
                    <img src="{{ asset('storage/'.$first) }}"
                         class="img-front"
                         alt="{{ $product->title }}">

                    {{-- back obrazok (ak existuje) --}}
                    @if ($second)
                        <img src="{{ asset('storage/'.$second) }}"
                             class="img-back"
                             alt="{{ $product->title }} alt view">
                    @endif
                </div>

                <div class="product-title">
                    {{ Str::upper($product->title) }}
                </div>

                <div class="product-price">
                    {{ number_format($product->price, 2, ',', ' ') }} €
                    <span class="tax">s DPH</span>
                </div>
            </a>
        @endforeach
    </div>

    {{-- ================= PAGINATION ======================== --}}
    <div class="d-flex justify-content-center">
        {{ $products->links('vendor.pagination.bootstrap-5') }}
    </div>

    {{-- ================= FILTER SIDEBAR ==================== --}}
    <div id="filterSidebar">
        <div class="filter-header">
            <h4>Filter</h4>
            <span class="close-filter" id="closeFilter">&times;</span>
        </div>

        <div class="filter-content">
            {{-- ---- PRICE RANGE ------------------------------ --}}
            <div class="filter-group">
                <h5>Price (€)</h5>

                <div class="price-input">
                    <div class="field">
                        <input type="number" class="input-min" value="0">
                    </div>
                    <span class="separator">–</span>
                    <div class="field">
                        <input type="number" class="input-max" value="500">
                    </div>
                </div>

                <div class="slider"><div class="progress"></div></div>

                <div class="range-input">
                    <input type="range" class="range-min" min="0" max="500" value="0" step="1">
                    <input type="range" class="range-max" min="0" max="500" value="500" step="1">
                </div>
            </div>

            {{-- ---- CATEGORY EXAMPLE ------------------------- --}}
            <div class="filter-group">
                <h5>Category</h5>
                <label><input type="checkbox"> Rings</label><br>
                <label><input type="checkbox"> Necklaces</label><br>
                <label><input type="checkbox"> Bracelets</label>
            </div>

            <button class="btn-apply-filter">Apply Filters</button>
        </div>
    </div>

    {{-- overlay --}}
    <div id="overlay"></div>
@endsection
