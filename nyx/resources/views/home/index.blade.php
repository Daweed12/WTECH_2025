<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Nyx | Home</title>

    <style>
        html, body { height: 100%; margin: 0; }
        body {
            display: flex;
            flex-direction: column;      /* aby header zostal hore a text v strede */
            background: linear-gradient(135deg, #d7d2cc, #304352);
            font-family: "Segoe UI", Arial, sans-serif;
            color: #fff;
        }
        main {                            /* centrálny blok s tvojím textom */
            flex: 1;                     /* vyplní zvyšok výšky medzi headerom a prípadným footerom */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        h1 { font-size: 3rem; text-shadow: 0 2px 4px rgba(0,0,0,.3); }
    </style>
</head>
<body>

{{-- 1 ) HEADER (top‑bar + navbar) --}}
@include('partials.header')

{{-- 2 ) HLAVNÝ OBSAH STRÁNKY --}}
<main>
    {{-- podmienka z controlleru --}}
    @if($registered)
        <p>Vitaj späť, si prihlásený!</p>
    @else
        <p>Ahoj! Zvažuješ registráciu?</p>
    @endif

    <h1>
        Toto bude najlepšia stránka na svete, <br>
        to predsa už teraz všetci dobre viete, <br>
        Tak mi, prosím, šupnite štyri bodíky, <br>
        nech sa nám úsmev rozkvitne jak jarné kvietiky!
    </h1>
</main>

{{-- prípadný footer by mohol byť tu --}}
{{-- @include('partials.footer') --}}
</body>
</html>
