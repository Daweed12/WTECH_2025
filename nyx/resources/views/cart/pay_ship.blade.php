@extends('layouts.app')

@section('contents')
    <main class="container my-5">
        <!-- Progress Steps -->
        <div class="progress-steps">
            <div class="progress-line">
                <div class="progress-line-fill" style="width: 67%;"></div>
            </div>
            <!-- Step 1 - completed -->
            <div class="step completed">
                <span class="icon"><i class="fas fa-shopping-cart"></i></span>
                <span class="label">Cart Preview</span>
            </div>
            <!-- Step 2 - active -->
            <div class="step active">
                <span class="icon"><i class="fas fa-truck"></i></span>
                <span class="label">Address & Shipping</span>
            </div>
            <!-- Step 3 -->
            <div class="step">
                <span class="icon"><i class="fas fa-credit-card"></i></span>
                <span class="label">Payment</span>
            </div>
            <!-- Step 4 -->
            <div class="step">
                <span class="icon"><i class="fas fa-check"></i></span>
                <span class="label">Order Review</span>
            </div>
        </div>

        <form action="{{ route('cart.payment') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Payment & Delivery Options -->
                <div class="col-lg-8 mb-5">
                    <!-- Payment Method Section -->
                    <h4 class="mb-3">Choose payment method</h4>
                    @foreach($paymentMethods as $method)
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div>
                                <input type="radio"
                                       name="payment_method"
                                       id="payment_{{ $method->id }}"
                                       value="{{ $method->id }}"
                                       class="form-check-input me-2"
                                    {{ $loop->first ? 'checked' : '' }}>
                                <label for="payment_{{ $method->id }}" class="form-check-label">{{ $method->name }}</label>
                            </div>
                            <span>{{ number_format($method->fee, 2) }} €</span>
                        </div>
                    @endforeach

                    <hr>

                    <!-- Delivery Method Section -->
                    <h4 class="mb-3">Delivery Method</h4>
                    @foreach($deliveryMethods as $method)
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div>
                                <input type="radio"
                                       name="delivery_method"
                                       id="delivery_{{ $method->id }}"
                                       value="{{ $method->id }}"
                                       class="form-check-input me-2"
                                    {{ $loop->first ? 'checked' : '' }}>
                                <label for="delivery_{{ $method->id }}" class="form-check-label">{{ $method->name }}</label>
                            </div>
                            <span>{{ number_format($method->fee, 2) }} €</span>
                        </div>
                    @endforeach
                </div>

                <!-- Summary -->
                <div class="col-lg-4">
                    <div class="border p-4">
                        <h4 class="mb-3">Summary</h4>
                        <div class="mb-3 d-flex justify-content-between">
                            <span>Subtotal:</span>
                            <span class="fw-bold">{{ number_format($cart->subtotal(), 2) }} €</span>
                        </div>
                        @if(session('discount'))
                            <div class="mb-2 d-flex justify-content-between">
                                <span>Discount</span>
                                <span>-{{ number_format(session('discount'), 2) }} €</span>
                            </div>
                        @endif
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total</span>
                            <span>{{ number_format($cart->total(), 2) }} €</span>
                        </div>

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('cart.address') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection
