<section class="best-sellers">
    <h2 class="font-semibold mb-4">Najpredávanejšie</h2>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        @foreach ($products as $product)
            <a href="{{ route('products.show', $product) }}" class="group border p-3 rounded hover:shadow">
                <img src="{{ $product->thumbnail_url }}"
                     alt="{{ $product->name }}"
                     class="w-full aspect-square object-cover mb-2 transition group-hover:scale-105">
                <div class="text-sm">{{ $product->name }}</div>
                <div class="font-semibold">
                    {{ number_format($product->price, 2, ',', ' ') }} €
                </div>
            </a>
        @endforeach
    </div>
</section>
