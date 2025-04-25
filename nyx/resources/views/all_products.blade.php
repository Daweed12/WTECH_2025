@extends('layout.app')

@php use Illuminate\Support\Str; @endphp

{{-- vlastné CSS + JS cez Vite --}}
@vite([
    'resources/css/products.css',
    'resources/js/slider.js',
])

@section('contents')

    

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
                $second = $product->images[1]->url ?? null;
            @endphp

            <a href="#"
               class="product-container text-decoration-none text-dark">
                <div class="image-wrapper">
                    <img src="{{ asset('storage/'.$first) }}"
                         class="img-front"
                         alt="{{ $product->title }}">

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
    {{-- ... (zvyšok ostáva nezmenený) --}}
@endsection
