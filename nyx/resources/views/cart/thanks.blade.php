{{-- resources/views/cart/thanks.blade.php --}}

@extends('layout.app')

@section('contents')
    <div class="container my-5">
        <h2 class="mb-4">Ďakujeme za vašu objednávku!</h2>

        <p class="lead">
            Vaša objednávka bola úspešne prijatá a práve ju spracovávame.
            Čoskoro vám pošleme potvrdenie e-mailom s detailmi vašej objednávky.
        </p>

        {{-- Voliteľne: ak máte číslo objednávky v session --}}
        @if(session('order_id'))
            <p>
                <strong>Číslo objednávky:</strong>
                {{ session('order_id') }}
            </p>
        @endif

        <div class="mt-5 d-flex justify-content-center">
            <a href="{{ route('home') }}" class="btn btn-primary me-3">
                Späť na úvod
            </a>
            <a href="{{ route('cart.preview') }}" class="btn btn-secondary">
                Zobraziť košík
            </a>
        </div>
    </div>
@endsection
