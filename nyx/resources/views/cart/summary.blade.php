@extends('layouts.app')

@section('contents')
    <main class="container my-5">
        <!-- Progress Steps -->
        <div class="progress-steps">
            <div class="progress-line">
                <div class="progress-line-fill" style="width: 100%;"></div>
            </div>
            <div class="step completed">
                <span class="icon"><i class="fas fa-shopping-cart"></i></span>
                <span class="label">Cart Preview</span>
            </div>
            <div class="step completed">
                <span class="icon"><i class="fas fa-truck"></i></span>
                <span class="label">Address & Shipping</span>
            </div>
            <div class="step completed">
                <span class="icon"><i class="fas fa-credit-card"></i></span>
                <span class="label">Payment</span>
            </div>
            <div class="step active">
                <span class="icon"><i class="fas fa-check"></i></span>
                <span class="label">Order Review</span>
            </div>
        </div>

        <h2 class="mb-4">Order Review</h2>
        <div class="row">
            <div class="col-lg-8 mb-5">
                <!-- Items Summary -->
                <div class="mb-4">
                    <h4>Items</h4>
                    @foreach($cart->items as $item)
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="img-thumbnail" style="width: 75px; height: auto;">
                            </div>
                            <div>
                                <h6>{{ $item->product->name }}</h6>
                                <p class="mb-1">Qty: {{ $item->quantity }}</p>
                                <p class="mb-1">Price: {{ number_format($item->product->price * $item->quantity, 2) }} €</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Shipping Address -->
                <div class="mb-4">
                    <h4>Shipping Address</h4>
                    <address>
                        {{ $address->first_name }} {{ $address->last_name }}<br>
                        {{ $address->address_line1 }}<br>
                        @if($address->address_line2){{ $address->address_line2 }}<br>@endif
                        {{ $address->postal_code }} {{ $address->city }}<br>
                        {{ $address->country }}<br>
                        Email: {{ $address->email }}<br>
                        @if($address->phone)Phone: {{ $address->phone }}<br>@endif
                    </address>
                </div>

                <!-- Payment & Delivery -->
                <div class="mb-4">
                    <h4>Payment & Delivery</h4>
                    <p>Payment Method: {{ $paymentMethod->name }} (Fee: {{ number_format($paymentMethod->fee, 2) }} €)</p>
                    <p>Delivery Method: {{ $deliveryMethod->name }} (Fee: {{ number_format($deliveryMethod->fee, 2) }} €)</p>
                </div>

                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Confirm Order</button>
                    <a href="{{ route('cart.payment') }}" class="btn btn-secondary ms-2">Back</a>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="border p-4">
                    <h4 class="mb-3">Summary</h4>
                    <div class="mb-2 d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span>{{ number_format($cart->subtotal(), 2) }} €</span>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span>Payment Fee</span>
                        <span>{{ number_format($paymentMethod->fee, 2) }} €</span>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span>Delivery Fee</span>
                        <span>{{ number_format($deliveryMethod->fee, 2) }} €</span>
                    </div>
                    @if(session('discount'))
                        <div class="mb-2 d-flex justify-content-between">
                            <span>Discount</span>
                            <span>-{{ number_format(session('discount'), 2) }} €</span>
                        </div>
                    @endif
                    <hr>
                    <div class="fw-bold d-flex justify-content-between">
                        <span>Total</span>
                        <span>{{ number_format($cart->total() + $paymentMethod->fee + $deliveryMethod->fee - session('discount', 0), 2) }} €</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
