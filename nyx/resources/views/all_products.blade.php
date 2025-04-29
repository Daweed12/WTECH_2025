{{-- resources/views/all_products.blade.php --}}
@extends('layout.app')

@php use Illuminate\Support\Str; @endphp

@vite([
    'resources/css/products.css',
    'resources/js/slider.js',
])

@section('contents')

    <main class="container my-5">
    {{-- Search heading --}}
    @if (!empty($query))
        <h4 class="text-center my-4">
            Results for “{{ $query }}” ({{ $products->total() }})
        </h4>
    @endif

    {{-- Sort + Filter bar --}}
    <div class="sort-filter-container d-flex justify-content-between align-items-center mb-4">
        <a href="javascript:void(0)" id="openFilter" class="btn-filter">FILTER</a>
        <form method="GET" action="{{ route('products.index') }}" class="m-0 p-0">
            {{-- preserve category --}}
            @if($category)
                <input type="hidden" name="category" value="{{ $category }}">
            @endif
            {{-- preserve color --}}
            @foreach(request('color', []) as $c)
                <input type="hidden" name="color[]" value="{{ $c }}">
            @endforeach
            {{-- preserve gender --}}
            @foreach(request('gender', []) as $g)
                <input type="hidden" name="gender[]" value="{{ $g }}">
            @endforeach
            {{-- preserve price --}}
            @if(request('min_price'))
                <input type="hidden" name="min_price" value="{{ request('min_price') }}">
            @endif
            @if(request('max_price'))
                <input type="hidden" name="max_price" value="{{ request('max_price') }}">
            @endif
            {{-- preserve search --}}
            @if($query)
                <input type="hidden" name="q" value="{{ $query }}">
            @endif

            <select name="sort" class="order-by" onchange="this.form.submit()">
                <option value="popularity" {{ $sort=='popularity' ? 'selected':'' }}>
                    ORDER BY POPULARITY
                </option>
                <option value="price-asc" {{ $sort=='price-asc' ? 'selected':'' }}>
                    PRICE ↑
                </option>
                <option value="price-desc" {{ $sort=='price-desc' ? 'selected':'' }}>
                    PRICE ↓
                </option>
            </select>
        </form>
    </div>

    <div id="overlay"></div>

    {{-- Filter Sidebar --}}
    <div id="filterSidebar">
        <div class="filter-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Filter</h5>
            <span id="closeFilter" class="close-filter">&times;</span>
        </div>
        <div class="filter-content">
            <form method="GET" action="{{ route('products.index') }}">
                {{-- preserve search + sort --}}
                @if($query)
                    <input type="hidden" name="q" value="{{ $query }}">
                @endif
                @if($sort)
                    <input type="hidden" name="sort" value="{{ $sort }}">
                @endif

                {{-- Category --}}
                <div class="filter-group">
                    <h5>Category</h5>
                    @foreach([
                        'necklaces' => 'Necklaces',
                        'rings'     => 'Rings',
                        'earrings'  => 'Earrings',
                        'bracelets' => 'Bracelets',
                    ] as $val => $label)
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="radio"
                                   name="category"
                                   id="cat-{{ $val }}"
                                   value="{{ $val }}"
                                {{ $category === $val ? 'checked':'' }}>
                            <label class="form-check-label" for="cat-{{ $val }}">
                                {{ $label }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <hr>

                {{-- Material (color) --}}
                <div class="filter-group">
                    <h5>Material</h5>
                    @foreach(['diamond','gold','silver'] as $c)
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="color[]"
                                   id="col-{{ $c }}"
                                   value="{{ $c }}"
                                {{ in_array($c, $color ?? []) ? 'checked':'' }}>
                            <label class="form-check-label text-capitalize"
                                   for="col-{{ $c }}">
                                {{ $c }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <hr>

                {{-- Gender --}}
                <div class="filter-group">
                    <h5>Gender</h5>
                    @foreach([
                        'man'     => 'Man',
                        'woman'   => 'Woman',
                        'unisex' => 'Unisex',
                    ] as $val => $label)
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="gender[]"
                                   id="gen-{{ $val }}"
                                   value="{{ $val }}"
                                {{ in_array($val, $gender ?? []) ? 'checked':'' }}>
                            <label class="form-check-label" for="gen-{{ $val }}">
                                {{ $label }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <hr>

                {{-- Price --}}
                <div class="filter-group">
                    <h5>Price</h5>
                    <div class="d-flex align-items-center mb-3">
                        <div class="price-field me-3">
                            <label for="min_price">Min</label>
                            <input type="number"
                                   id="min_price"
                                   class="input-min form-control"
                                   name="min_price"
                                   value="{{ $min_price }}"
                                   min="0" max="500">
                        </div>
                        <span class="mx-2">-</span>
                        <div class="price-field">
                            <label for="max_price">Max</label>
                            <input type="number"
                                   id="max_price"
                                   class="input-max form-control"
                                   name="max_price"
                                   value="{{ $max_price }}"
                                   min="0" max="500">
                        </div>
                    </div>
                    <div class="slider" id="priceSlider">
                        <div class="progress"></div>
                        <div class="thumb thumb-min"></div>
                        <div class="thumb thumb-max"></div>
                    </div>
                </div>

                <button type="submit" class="btn-apply-filter w-100 mb-2">
                    Apply Filters
                </button>
                <a href="{{ route('products.index') }}"
                   class="btn-clear-filters btn btn-outline-secondary w-100">
                    Clear Filters
                </a>
            </form>
        </div>
    </div>

    {{-- No products found --}}
    @if($products->isEmpty())
        <div class="no-products text-center my-5">
            <p>No products found.</p>
        </div>
    @else
        {{-- Products Grid --}}
        <div class="products-wrapper">
            @foreach ($products as $product)
                @php
                    $first  = $product->images[0]->url ?? null;
                    $second = $product->images[1]->url ?? null;
                @endphp
                <a href="{{ route('products.show', $product) }}"
                   class="product-container text-decoration-none text-dark">
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
                    <div class="product-title">
                        {{ Str::upper($product->title) }}
                    </div>
                    <div class="product-price">
                        €{{ number_format($product->price, 2, ',', ' ') }}
                    </div>
                </a>
            @endforeach
        </div>
    @endif

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('vendor.pagination.bootstrap-5') }}
    </div>
    </main>
@endsection
