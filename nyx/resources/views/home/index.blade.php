@extends('layouts.app')

@section('title', 'Nyx | Home')

{{-- ➜ sem pridávame len obsah stránky --}}
@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center text-center text-white"
         style="min-height: calc(100vh - 120px);  /* zvyšok výšky pod headerom */
                background: linear-gradient(135deg, #d7d2cc, #304352);">

        {{-- ukážková podmienka z controlleru --}}
        @if(!empty($registered) && $registered)
            <p class="mb-4">Vitaj späť, si prihlásený!</p>
        @else
            <p class="mb-4">Ahoj! Zvažuješ registráciu?</p>
        @endif

        <h1 class="display-5 fw-semibold">
            Toto bude najlepšia stránka na svete, <br>
            to predsa už teraz všetci dobre viete, <br>
            Tak mi, prosím, šupnite štyri bodíky, <br>
            nech sa nám úsmev rozkvitne jak jarné kvietiky!
        </h1>
    </div>
@endsection
