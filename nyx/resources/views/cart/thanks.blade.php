{{-- resources/views/cart/thanks.blade.php --}}

@extends('layout.app')

@section('contents')
    <div class="container my-5">
        <h2 class="mb-4">Thank you for your order!</h2>

        <p class="lead">
            Your order has been successfully received and is now being processed.
            We will send you an email confirmation with the details of your order shortly.
        </p>

        {{-- Voliteľne: ak máte číslo objednávky v session --}}
        @if(session('order_id'))
            <p>
                <strong>Order Number:</strong>
                {{ session('order_id') }}
            </p>
        @endif

        <div class="mt-5 d-flex justify-content-center">
            <a href="{{ route('home') }}" class="btn btn-primary me-3">
                Back to Home
            </a>
            <a href="{{ route('cart.preview') }}" class="btn btn-secondary">
                View Cart
            </a>
        </div>
    </div>
@endsection
