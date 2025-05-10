@extends('layout.app')

@section('contents')
    <div class="container my-5">
        <h2>Address & Shipping</h2>

        <form method="POST" action="{{ route('cart.address') }}">
            @csrf

            <div class="row">
                {{-- Ľavý stĺpec: údaje o adrese --}}
                <div class="col-md-6">
                    {{-- First Name --}}
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            class="form-control"
                            value="{{ old('first_name', optional($address)->first_name) }}"
                            required
                        >
                        @error('first_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Last Name --}}
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input
                            type="text"
                            id="last_name"
                            name="last_name"
                            class="form-control"
                            value="{{ old('last_name', optional($address)->last_name) }}"
                            required
                        >
                        @error('last_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Address Line 1 --}}
                    <div class="mb-3">
                        <label for="address_line_1" class="form-label">Address</label>
                        <input
                            type="text"
                            id="address_line_1"
                            name="address_line_1"
                            class="form-control"
                            value="{{ old('address_line_1', optional($address)->address_line_1) }}"
                            required
                        >
                        @error('address_line_1')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- City --}}
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input
                            type="text"
                            id="city"
                            name="city"
                            class="form-control"
                            value="{{ old('city', optional($address)->city) }}"
                            required
                        >
                        @error('city')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- ZIP / Postcode --}}
                    <div class="mb-3">
                        <label for="zip" class="form-label">Postcode</label>
                        <input
                            type="text"
                            id="zip"
                            name="zip"
                            class="form-control"
                            value="{{ old('zip', optional($address)->zip) }}"
                            required
                        >
                        @error('zip')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Country --}}
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input
                            type="text"
                            id="country"
                            name="country"
                            class="form-control"
                            value="{{ old('country', optional($address)->country) }}"
                            required
                        >
                        @error('country')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            class="form-control"
                            value="{{ old('phone', optional($address)->phone) }}"
                            required
                        >
                        @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Pravý stĺpec: zhrnutie košíka --}}
                <div class="col-md-6">
                    <h3>Order Summary</h3>
                    <div class="card">
                        <div class="card-body">
                            @if($cart->items->count())
                                <ul class="list-group mb-3">
                                    @foreach($cart->items as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $item->product->title }} (x{{ $item->quantity }})
                                            <span>€{{ number_format($item->price * $item->quantity, 2, ',', ' ') }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="d-flex justify-content-between">
                                    <strong>Total:</strong>
                                    <strong>€{{ number_format($cart->total(), 2, ',', ' ') }}</strong>
                                </div>
                            @else
                                <p>Your cart is empty.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tlačidlá pod formulárom --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('cart.preview') }}" class="btn btn-secondary">Back to Cart</a>
                        <button type="submit" class="btn btn-primary">Continue to Payment</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
