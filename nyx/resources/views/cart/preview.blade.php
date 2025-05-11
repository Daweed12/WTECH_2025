
@extends('layout.app')

@vite([
    'resources/css/product_detail.css',
    'resources/css/best-sellers.css',
    'resources/css/cart2.css'
])

@section('contents')
    <main class="container my-5">

        <!-- Progress Steps -->
        <div class="progress-steps mb-4">
            <div class="progress-line">
                <div class="progress-line-fill" style="width: 0%;"></div>
            </div>
            <div class="step active">
                <span class="icon"><i class="fas fa-shopping-cart"></i></span>
                <span class="label">Cart Preview</span>
            </div>
            <div class="step">
                <span class="icon"><i class="fas fa-truck"></i></span>
                <span class="label">Address</span>
            </div>
            <div class="step">
                <span class="icon"><i class="fas fa-credit-card"></i></span>
                <span class="label">Payment & Shipping</span>
            </div>
            <div class="step">
                <span class="icon"><i class="fas fa-check"></i></span>
                <span class="label">Order Review</span>
            </div>
        </div>

        <!-- Page Title -->
        <h2 class="mb-4">Your Cart</h2>

        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="cart-container">
                    @forelse($cart->items as $item)
                        <div class="cart-item">

                            <div class="item-image">
                                @if($item->product->images->isNotEmpty())
                                    <img
                                            src="{{ asset('storage/' . $item->product->images->first()->url) }}"
                                            alt="{{ $item->product->title }}"
                                    >
                                @else
                                    <img
                                            src="{{ asset('storage/defaults/no-image.png') }}"
                                            alt="No image"
                                    >
                                @endif
                            </div>

                            <div class="item-details">
                                <h3 class="item-title">{{ $item->product->title }}</h3>
                                <p class="item-subtitle">
                                    {{ $item->product->metal ?? '' }}
                                    {{ $item->product->metal && $item->product->stone ? ', ' : '' }}
                                    {{ $item->product->stone ?? '' }}
                                    {{ $item->product->stone && $item->product->month ? ' – ' : '' }}
                                    {{ $item->product->month ?? '' }}
                                </p>
                            </div>

                            <div class="item-price">
                                €{{ number_format($item->price, 2, ',', '') }}
                            </div>

                            <form
                                    method="POST"
                                    action="{{ route('cart.update', $item->id) }}"
                                    class="item-qty"
                            >
                                @csrf
                                @method('PATCH')
                                <button type="button" class="qty-btn minus">–</button>
                                <input
                                        type="number"
                                        name="quantity"
                                        value="{{ $item->quantity }}"
                                        min="1"
                                >
                                <button type="button" class="qty-btn plus">+</button>
                            </form>

                            <form
                                    method="POST"
                                    action="{{ route('cart.remove', $item->id) }}"
                                    class="item-remove"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit">Remove</button>
                            </form>
                        </div>
                    @empty
                        <p>Your cart is currently empty.</p>
                    @endforelse
                </div>
            </div>

            <!-- Summary -->
            <div class="col-lg-4">
                <div class="card p-4 cart-summary">
                    <h4 class="mb-3">Summary</h4>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span class="fw-bold">€{{ number_format($cart->subtotal(), 2, ',', '') }}</span>
                    </div>
                    @php $hasItems = $cart->items->count() > 0; @endphp

                    <a
                        href="{{ $hasItems ? route('cart.address.form') : '#' }}"
                        class="btn btn-primary w-100 {{ $hasItems ? '' : 'disabled' }}"
                        @if(! $hasItems) aria-disabled="true" @endif
                    >
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>

        <hr class="my-5">

        <!-- Best Sellers -->
        <x-best-sellers :limit="4" />
    </main>
@endsection
@section('another_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            document.querySelectorAll('.item-qty').forEach(form => {
                const input = form.querySelector('input[name="quantity"]');
                form.querySelectorAll('.qty-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        let val = parseInt(input.value) || 1;
                        if (btn.classList.contains('minus')) {
                            if (val > 1) input.value = val - 1;
                        } else {
                            input.value = val + 1;
                        }
                        form.submit(); // <— hneď odošle form pre update
                    });
                });

                input.addEventListener('blur', () => {
                    let v = parseInt(input.value) || 1;
                    input.value = v < 1 ? 1 : v;
                    form.submit(); // <— odošle form po odchode z inputu
                });
            });
        });
    </script>

@endsection

