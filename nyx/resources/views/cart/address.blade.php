@extends('layouts.app')

@section('contents')
    <main class="container my-5">
        <h2 class="mb-4">Shipping Address</h2>
        <form action="{{ route('cart.address') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $address->first_name ?? '') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $address->last_name ?? '') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">E-mail Address</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $address->email ?? auth()->user()->email ?? '') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $address->phone ?? '') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="address_line1" class="form-label">Address Line 1</label>
                    <input type="text" name="address_line1" id="address_line1" class="form-control" value="{{ old('address_line1', $address->address_line1 ?? '') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="address_line2" class="form-label">Address Line 2</label>
                    <input type="text" name="address_line2" id="address_line2" class="form-control" value="{{ old('address_line2', $address->address_line2 ?? '') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $address->city ?? '') }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="postal_code" class="form-label">Postal Code</label>
                    <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code', $address->postal_code ?? '') }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="country" class="form-label">Country</label>
                    <select name="country" id="country" class="form-select" required>
                        <option value="">Select Country</option>
                        @foreach($countries as $code => $name)
                            <option value="{{ $code }}" {{ old('country', $address->country ?? '') == $code ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" value="1" id="save_address" name="save_address" {{ old('save_address', $address ? true : false) ? 'checked' : '' }}>
                <label class="form-check-label" for="save_address">
                    Save this address for future purchases
                </label>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('cart.preview') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Continue</button>
            </div>
        </form>
    </main>
@endsection

