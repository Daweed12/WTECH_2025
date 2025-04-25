@extends('layout.app')

@section('contents')
    <div class="container py-5">
        <h1 class="mb-4 fw-bold text-center">Všetky produkty</h1>

        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm">

                        {{-- prvý obrázok alebo fallback --}}
                        <img src="{{ $product->first_image_url }}"
                             class="card-img-top object-fit-cover"
                             style="height: 200px"
                             alt="{{ $product->title }}">

                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-semibold mb-2">{{ $product->title }}</h6>
                            <div class="d-flex justify-content-between mt-auto">
                            <span class="fw-bold">
                                {{ number_format($product->price, 2, ',', ' ') }} €
                            </span>
                                <a href="#" class="btn btn-sm btn-primary">Do košíka</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $products->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection
