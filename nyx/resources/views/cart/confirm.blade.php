@extends('layout.app')

@section('contents')
    <div class="container my-5">
        <h2>Order confirmation</h2>

        {{-- Adresa, doprava, platba atď. ako doteraz --}}

        {{-- Položky v objednávke --}}
        <div class="card mb-4">
            <div class="card-body">
                <h4>Items in your order</h4>
                <ul class="list-group mb-3">
                    @foreach($order->items as $item)
                        @php
                            $unitPrice = $item->price - ($item->discount ?? 0);
                            $lineTotal = $unitPrice * $item->quantity;
                        @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                {{ $item->product->title }} (x{{ $item->quantity }})<br>
                                <small>SKU: {{ $item->sku }}</small>
                            </div>
                            <div class="text-end">
                                <div>€{{ number_format($unitPrice, 2, ',', ' ') }} &times; {{ $item->quantity }}</div>
                                <strong>€{{ number_format($lineTotal, 2, ',', ' ') }}</strong>
                            </div>
                        </li>
                    @endforeach
                </ul>

                @php
                    // Dynamický výpočet Subtotal
                    $subtotal    = $order->items->sum(function($item) {
                        $unit = $item->price - ($item->discount ?? 0);
                        return $unit * $item->quantity;
                    });
                    // Poplatky z objednávky
                    $deliveryFee = $order->delivery_fee ?? 0;
                    $paymentFee  = $order->payment_fee  ?? 0;
                    // Celková suma
                    $total       = $subtotal + $deliveryFee + $paymentFee;
                @endphp

                <div class="d-flex justify-content-between">
                    <strong>Subtotal:</strong>
                    <span>€{{ number_format($subtotal, 2, ',', ' ') }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <strong>Shipping:</strong>
                    <span>€{{ number_format($deliveryFee, 2, ',', ' ') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <strong>Payment fee:</strong>
                    <span>€{{ number_format($paymentFee, 2, ',', ' ') }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <strong>Total:</strong>
                    <strong>€{{ number_format($total, 2, ',', ' ') }}</strong>
                </div>
            </div>
        </div>

        {{-- Späť / Potvrdiť --}}
        <form action="{{ route('cart.finalize') }}" method="POST">
            @csrf
            <div class="d-flex justify-content-between">
                <a href="{{ route('cart.payment.form') }}" class="btn btn-secondary">Späť</a>
                <button type="submit" class="btn btn-success">Potvrdiť objednávku</button>
            </div>
        </form>
    </div>
@endsection
