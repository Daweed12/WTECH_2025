@extends('layout.app')

@section('contents')
    <div class="container my-5">
        <h2>Payment & Shipping</h2>

        <form action="{{ route('cart.payment') }}" method="POST" id="payment-form">
            @csrf
            <div class="row">

                <div class="col-md-6">
                    <h4>Shipping</h4>
                    @foreach($deliveryMethods as $method)
                        <div class="form-check mb-2">
                            <input
                                class="form-check-input delivery-radio"
                                type="radio"
                                name="delivery_method"
                                id="delivery_{{ $method->id }}"
                                value="{{ $method->id }}"
                                data-fee="{{ $method->fee }}"
                                {{ old('delivery_method', $deliveryMethods->first()->id) == $method->id ? 'checked' : '' }}
                                required
                            >
                            <label class="form-check-label" for="delivery_{{ $method->id }}">
                                {{ $method->name }} ({{ number_format($method->fee,2,',',' ') }} €)
                            </label>
                        </div>
                    @endforeach

                    <h4 class="mt-4">Payment fee</h4>
                    @foreach($paymentMethods as $method)
                        <div class="form-check mb-2">
                            <input
                                class="form-check-input payment-radio"
                                type="radio"
                                name="payment_method"
                                id="payment_{{ $method->id }}"
                                value="{{ $method->id }}"
                                data-fee="{{ $method->fee }}"
                                {{ old('payment_method',$paymentMethods->first()->id) == $method->id ? 'checked' : '' }}
                                required
                            >
                            <label class="form-check-label" for="payment_{{ $method->id }}">
                                {{ $method->name }} ({{ number_format($method->fee,2,',',' ') }} €)
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-6">
                    <h3>Order Summary</h3>
                    <div class="card mb-3">
                        <div class="card-body">

                            @if($address)
                                <p><strong>Shipping to:</strong><br>
                                    @if(is_array($address))
                                        {{ $address['first_name'] }} {{ $address['last_name'] }}<br>
                                        {{ $address['address_line_1'] }}<br>
                                        {{ $address['city'] }}, {{ $address['zip'] }}<br>
                                        {{ $address['country'] }}<br>
                                        Tel: {{ $address['phone'] }}
                                    @else
                                        {{ $address->first_name }} {{ $address->last_name }}<br>
                                        {{ $address->address_line_1 }}<br>
                                        {{ $address->city }}, {{ $address->zip }}<br>
                                        {{ $address->country }}<br>
                                        Tel: {{ $address->phone }}
                                    @endif
                                </p>
                                <hr>
                            @endif

                            @if($cart->items->count())
                                <ul class="list-group mb-3">
                                    @foreach($cart->items as $item)
                                        <li class="list-group-item d-flex justify-content-between">
                                            {{ $item->product->title }} (x{{ $item->quantity }})
                                            <span>€{{ number_format($item->price * $item->quantity,2,',',' ') }}</span>
                                        </li>
                                    @endforeach
                                </ul>

                                @php
                                    $subtotal     = $cart->subtotal();
                                    $delMethod    = $deliveryMethods->firstWhere('id', old('delivery_method',$deliveryMethods->first()->id));
                                    $payMethod    = $paymentMethods->firstWhere('id', old('payment_method',$paymentMethods->first()->id));
                                    $deliveryFee  = $delMethod->fee;
                                    $paymentFee   = $payMethod->fee;
                                    $total        = $subtotal + $deliveryFee + $paymentFee;
                                @endphp

                                <div class="d-flex justify-content-between">
                                    <strong>Subtotal:</strong>
                                    <span id="subtotal-amount">€{{ number_format($subtotal,2,',',' ') }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <strong>Shipping:</strong>
                                    <span id="shipping-fee">€{{ number_format($deliveryFee,2,',',' ') }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <strong>Payment fee:</strong>
                                    <span id="payment-fee">€{{ number_format($paymentFee,2,',',' ') }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <strong>Total:</strong>
                                    <strong id="total-amount">€{{ number_format($total,2,',',' ') }}</strong>
                                </div>
                            @else
                                <p>Empty cart.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('cart.preview') }}" class="btn btn-secondary">Back to cart</a>
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('another_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const subtotal = parseFloat("{{ $subtotal }}".replace(',', '.')) || 0;

            function formatPrice(value) {
                const parts = value.toFixed(2).split('.');
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                return '€' + parts[0] + ',' + parts[1];
            }

            function updateSummary() {
                const deliveryFee = parseFloat(document.querySelector('input[name="delivery_method"]:checked').dataset.fee) || 0;
                const paymentFee  = parseFloat(document.querySelector('input[name="payment_method"]:checked').dataset.fee)  || 0;
                const total       = subtotal + deliveryFee + paymentFee;

                document.getElementById('shipping-fee').textContent = formatPrice(deliveryFee);
                document.getElementById('payment-fee').textContent  = formatPrice(paymentFee);
                document.getElementById('total-amount').textContent = formatPrice(total);
            }

            document.querySelectorAll('.delivery-radio, .payment-radio')
                .forEach(radio => radio.addEventListener('change', updateSummary));
        });
    </script>
@endsection

