<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Nyx')</title>

    {{-- Bootstrap & Font‑Awesome CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- rýchle štýly pre hornú lištu (premiestni si ich pokojne do CSS) --}}
    <style>
        .top-ribbon      { height: 6px; background:#212529; }
        .top-bar-white   { background:#fff; border-bottom:2px solid #5a0040; }
        .sign-link       { color:#000; font-weight:500; text-decoration:none }
        .sign-link:hover { text-decoration:underline; }
    </style>

    @stack('head') {{-- umožní stránkam doplniť <style> alebo <link> --}}
</head>
<body class="d-flex flex-column min-vh-100">

{{-- HEADER (úzky pásik + sign‑in lišta) --}}
@include('partials.header')

{{-- NAVBAR (samostatný partial – už ho máš vytvorený) --}}
@include('partials.navbar')

{{-- HLAVNÁ ČASŤ STRÁNKY --}}
<main class="flex-fill">
    @yield('content')
</main>

{{-- FOOTER (iba ak existuje) --}}
@includeIf('partials.footer')

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts') {{-- ak nejaká stránka potrebuje vlastný JS --}}
</body>
</html>
