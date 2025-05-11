@php use Illuminate\Support\Str; @endphp

<section class="best-sellers my-5">
    <h2 class="display-6 fw-bold mb-3">Best Sellers</h2>
    <hr class="opacity-25 mb-4">

    <div class="row row-cols-2 row-cols-md-4 g-4">
        @foreach ($products as $product)
            <div class="col">
                <a href="{{ route('products.show', $product) }}"
                   class="bs-item d-block text-decoration-none text-dark">

                    <div class="bs-img">
                        <img src="{{ $product->thumbnail_url }}"
                             alt="{{ $product->name }}">
                    </div>

                    <h3 class="bs-name mt-2 mb-1">
                        {{ Str::upper($product->title) }}
                    </h3>
                    <p class="bs-price mb-0">
                        €{{ number_format($product->price, 2, ',', ' ') }}
                    </p>
                </a>
            </div>
        @endforeach
    </div>
</section>

