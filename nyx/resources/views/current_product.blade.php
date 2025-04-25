{{-- resources/views/current_product.blade.php --}}

@extends('layout.app')

@php
    use Illuminate\Support\Str;
@endphp

{{-- Pridáme vlastné CSS pre detail produktu --}}
@vite(['resources/css/product_detail.css'])

@section('contents')
    <div class="container product-detail my-5">
        <div class="row g-5 align-items-start">

            {{-- ================= Obrázkový slider ================= --}}
            <div class="col-lg-6">
                @if($product->images->isNotEmpty())
                    <div id="productCarousel"
                         class="carousel slide position-relative"
                         data-bs-interval="false">

                        <div class="carousel-inner">
                            @foreach($product->images as $i => $img)
                                <div class="carousel-item @if($i === 0) active @endif">
                                    <img src="{{ asset('storage/' . $img->url) }}"
                                         class="d-block w-100 main-img rounded"
                                         alt="Slide {{ $i + 1 }}">
                                </div>
                            @endforeach
                        </div>

                        {{-- Šípka ← --}}
                        <button class="carousel-control-prev" type="button"
                                data-bs-target="#productCarousel"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        {{-- Šípka → --}}
                        <button class="carousel-control-next" type="button"
                                data-bs-target="#productCarousel"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>

                        {{-- Thumbnaily pod carouselom --}}
                        <div class="carousel-indicators custom-indicators">
                            @foreach($product->images as $i => $img)
                                <button type="button"
                                        data-bs-target="#productCarousel"
                                        data-bs-slide-to="{{ $i }}"
                                        class="@if($i === 0) active @endif"
                                        aria-label="Slide {{ $i + 1 }}">
                                    <img src="{{ asset('storage/' . $img->url) }}"
                                         class="thumb-img rounded"
                                         alt="Thumb {{ $i + 1 }}">
                                </button>
                            @endforeach
                        </div>
                    </div>
                @else
                    <img src="{{ asset('storage/defaults/no-image.png') }}"
                         class="img-fluid main-img rounded"
                         alt="No image available">
                @endif
            </div>

            {{-- ================= Informácie o produkte ================= --}}
            <div class="col-lg-6">
                <h1 class="product-title">{{ Str::title($product->title) }}</h1>

                <p class="product-price h4 fw-semibold mb-1">
                    €{{ number_format($product->price, 2, ',', ' ') }}
                </p>

                @if($product->discount > 0)
                    <p class="text-danger mb-3">
                        Discount: €{{ number_format($product->discount, 2, ',', ' ') }}
                    </p>
                @endif

                <span class="badge bg-success mb-4">In Stock</span>

                <p class="product-description mb-4">
                    {{ $product->description }}
                </p>

                {{-- ======= Množstvo + tlačidlo ======= --}}
                <div class="add-to-cart-form d-flex align-items-center gap-3 mb-5">
                    <div class="quantity-wrapper d-flex align-items-center">
                        <button type="button" class="qty-btn minus">−</button>
                        <input type="number" value="1" min="1"
                               class="qty-input form-control text-center">
                        <button type="button" class="qty-btn plus">+</button>
                    </div>

                    <button type="button" class="btn btn-primary btn-lg">
                        ADD TO CART&nbsp;{{ number_format($product->price, 2, ',', ' ') }} €
                    </button>
                </div>

                {{-- ======= DETAIL z databázy ======= --}}
                <h5 class="detail-heading fw-bold mb-2">DETAIL:</h5>
                @php
                    $details = is_array($product->details)
                        ? $product->details
                        : preg_split('/\r?\n/', trim((string)$product->details));
                @endphp

                @if(!empty($details))
                    <ul class="detail-list mb-0">
                        @foreach($details as $line)
                            @if(trim($line) !== '')
                                <li>{{ $line }}</li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No additional details available.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('another_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.qty-btn.minus').forEach(btn => {
                btn.addEventListener('click', () => {
                    const input = btn.nextElementSibling;
                    let val = parseInt(input.value) || 1;
                    if (val > 1) input.value = val - 1;
                });
            });
            document.querySelectorAll('.qty-btn.plus').forEach(btn => {
                btn.addEventListener('click', () => {
                    const input = btn.previousElementSibling;
                    let val = parseInt(input.value) || 1;
                    input.value = val + 1;
                });
            });
        });
    </script>
@endsection
