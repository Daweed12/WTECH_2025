@extends('layout.app')

@section('contents')
    <div class="container my-5">
        <h2>Platba a doprava</h2>

        <form action="{{ route('cart.payment') }}" method="POST">
            @csrf
            <div class="row">
                {{-- Ľavý stĺpec: doprava & platba --}}
                <div class="col-md-6">
                    <h4>Doprava</h4>
                    @foreach($deliveryMethods as $method)
                        <div class="form-check mb-2">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="delivery_method"
                                id="delivery_{{ $method->id }}"
                                value="{{ $method->id }}"
                                {{ old('delivery_method', $deliveryMethods->first()->id) == $method->id ? 'checked' : '' }}
                                required
                            >
                            <label class="form-check-label" for="delivery_{{ $method->id }}">
                                {{ $method->name }} ({{ number_format($method->fee,2,',',' ') }} €)
                            </label>
                        </div>
                    @endforeach

                    <h4 class="mt-4">Platba</h4>
                    @foreach($paymentMethods as $method)
                        <div class="form-check mb-2">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="payment_method"
                                id="payment_{{ $method->id }}"
                                value="{{ $method->id }}"
                                {{ old('payment_method',$paymentMethods->first()->id) == $method->id ? 'checked' : '' }}
                                required
                            >
                            <label class="form-check-label" for="payment_{{ $method->id }}">
                                {{ $method->name }} ({{ number_format($method->fee,2,',',' ') }} €)
                            </label>
                        </div>
                    @endforeach
                </div>

                {{-- Pravý stĺpec: zhrnutie a adresa --}}
                <div class="col-md-6">
                    <h3>Order Summary</h3>
                    <div class="card mb-3">
                        <div class="card-body">
                            {{-- Adresa --}}
                            @if($address)
                                <p><strong>Shipping to:</strong><br>
                                    @if(is_array($address))
                                        {{-- guest_address zo session --}}
                                        {{ $address['first_name'] }} {{ $address['last_name'] }}<br>
                                        {{ $address['address_line_1'] }}<br>
                                        {{ $address['city'] }}, {{ $address['zip'] }}<br>
                                        {{ $address['country'] }}<br>
                                        Tel: {{ $address['phone'] }}
                                    @else
                                        {{-- authenticated --}}
                                        {{ $address->first_name }} {{ $address->last_name }}<br>
                                        {{ $address->address_line_1 }}<br>
                                        {{ $address->city }}, {{ $address->zip }}<br>
                                        {{ $address->country }}<br>
                                        Tel: {{ $address->phone }}
                                    @endif
                                </p>
                                <hr>
                            @endif

                            {{-- Položky košíka --}}
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
                                    $payMethod    = $paymentMethods->firstWhere('id', old('payment_method',   $paymentMethods->first()->id));
                                    $deliveryFee  = $delMethod->fee;
                                    $paymentFee   = $payMethod->fee;
                                    $total        = $subtotal + $deliveryFee + $paymentFee;
                                @endphp

                                <div class="d-flex justify-content-between"><strong>Subtotal:</strong><span>€{{ number_format($subtotal,2,',',' ') }}</span></div>
                                <div class="d-flex justify-content-between"><strong>Doprava:</strong><span>€{{ number_format($deliveryFee,2,',',' ') }}</span></div>
                                <div class="d-flex justify-content-between mb-3"><strong>Platba:</strong><span>€{{ number_format($paymentFee,2,',',' ') }}</span></div>
                                <div class="d-flex justify-content-between"><strong>Total:</strong><strong>€{{ number_format($total,2,',',' ') }}</strong></div>
                            @else
                                <p>Košík je prázdny.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tlačidlá pod formulárom --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('cart.preview') }}" class="btn btn-secondary">Späť do košíka</a>
                        <button type="submit" class="btn btn-primary">Dokončiť objednávku</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
