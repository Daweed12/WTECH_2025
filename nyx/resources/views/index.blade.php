<!DOCTYPE html>
<p lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Nyx | Home</title>

    <style>
        /* mini‑štýl, aby to vyzeralo elegantne */
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            justify-content: center;      /* vodorovné centrovanie */
            align-items: center;          /* zvislé centrovanie */
            background: linear-gradient(135deg, #d7d2cc, #304352);
            font-family: "Segoe UI", Arial, sans-serif;
            color: #fff;
        }

        h1 {
            font-size: 3rem;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
    </style>
</head>
<p>
{{-- index.blade.php --}}
@if($registered)
    <p>Vitaj späť, si prihlásený!</p>
@else
    <p>Ahoj! Zvažuješ registráciu?</p>
@endif
</p>
<body>

    <h1>Toto bude najlepšia stránka na svete, <br> to predsa už teraz všetci dobre viete, <br> Tak mi, prosím, šupnite štyri bodíky,<br>
        nech sa nám úsmev rozkvitne jak jarné kvietiky!</h1>


</body>
</html>
