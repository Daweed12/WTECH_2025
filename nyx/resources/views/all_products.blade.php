{{-- resources/views/all_products.blade.php --}}
@extends('layout.app')

@php
    /* Pre Str::upper() */
    use Illuminate\Support\Str;
@endphp

{{-- Vite --}}
@vite([
    'resources/css/products.css',
    'resources/js/slider.js',
])

@section('contents')

    {{-- ================= VÝSLEDKY VYHĽADÁVANIA ================= --}}
    @if (!empty($query ?? ''))
        <h4 class="text-center my-4">
            Results for “{{ $query }}” ({{ $products->total() }})
        </h4>
    @endif

    {{-- ================= SORT + FILTER BAR ================= --}}
    <div class="sort-filter-container d-flex justify-content-between align-items-center mb-4">
        {{-- FILTER tlačidlo vľavo --}}
        <a href="javascript:void(0)" id="openFilter" class="btn-filter">
            FILTER
        </a>

        {{-- zoradiť vpravo --}}
        <form method="GET" action="{{ route('products.index') }}" class="m-0 p-0">
            {{-- zachovať kategóriu --}}
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            {{-- zachovať vyhľadávanie --}}
            @if(request('q'))
                <input type="hidden" name="q" value="{{ request('q') }}">
            @endif

            <select name="sort"
                    class="order-by"
                    onchange="this.form.submit()">
                <option value="popularity" {{ request('sort')=='popularity' ? 'selected' : '' }}>
                    ORDER BY POPULARITY
                </option>
                <option value="price-asc" {{ request('sort')=='price-asc' ? 'selected' : '' }}>
                    PRICE ↑
                </option>
                <option value="price-desc" {{ request('sort')=='price-desc' ? 'selected' : '' }}>
                    PRICE ↓
                </option>
            </select>
        </form>
    </div>

    {{-- ================= PRODUCTS GRID ===================== --}}
    <div class="products-wrapper">
        @foreach ($products as $product)
            @php
                $first  = $product->images[0]->url ?? null;
                $second = $product->images[1]->url ?? null;
            @endphp

            <a href="{{ route('products.show', $product) }}"
               class="product-container text-decoration-none text-dark">

                {{-- Obrázky --}}
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

                {{-- Názov a cena --}}
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
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('vendor.pagination.bootstrap-5') }}
    </div>
@endsection
