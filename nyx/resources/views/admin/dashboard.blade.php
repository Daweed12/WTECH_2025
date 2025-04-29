@extends('layout.app')

@section('title', 'Admin Dashboard')

@section('contents')
    <div class="container py-4">

        <h1 class="mb-4 fw-bold">Admin mode</h1>
        <h4 class="mb-3">All items</h4>

        {{-- Mriežka produktov --}}
        <div class="row row-cols-2 row-cols-md-4 g-4">
            @forelse ($products as $product)
                <div class="col">
                    <div class="product-card">
                        {{-- Obrázok --}}
                        <img
                            src="{{ $product->first_image_url ?? asset('storage/defaults/no-image.png') }}"
                            alt="{{ $product->title }}"
                        >

                        {{-- Overlay zobrazený pri hovere --}}
                        <div class="product-card-overlay">
                            {{-- Akčné ikony vpravo hore --}}
                            <div class="action-icons">
                                <a href="{{ route('admin.products.edit', $product) }}" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <a  href="#"
                                    title="Delete"
                                    onclick="event.preventDefault(); if(confirm('Delete this product?')) document.getElementById('delete-{{ $product->id }}').submit();">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>

                            {{-- Názov produktu naspodku --}}
                            <h6 class="title-overlay">{{ strtoupper($product->title) }}</h6>
                        </div>
                    </div>

                    {{-- Cena pod kartou --}}
                    <p class="mt-2 mb-0 fw-semibold">
                        {{ number_format($product->price, 2) }} €
                        <span class="text-muted small">s DPH</span>
                    </p>

                    {{-- Skrytý DELETE formulár --}}
                    <form  id="delete-{{ $product->id }}"
                           method="POST"
                           action="{{ route('admin.products.destroy', $product) }}"
                           style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            @empty
                <p>No products yet.</p>
            @endforelse
        </div>

    </div>
@endsection
