<!DOCTYPE html>
<html class="dark @if(config('app.debug'))debug-screens @endif" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    @php
        //header("Strict-Transport-Security: max-age=31536000; includeSubDomains"); /* Weiterleitung HTTPS */;
        header("X-Frame-Options: SAMEORIGIN"); /* Einbindung als Iframe verbieten*/
        header("X-Content-Type-Options: style"); /* Automatisches Setzten von MIME-Type verbieten*/;
        header("Referrer-Policy: no-referrer"); /* Daten tracking abschalten DSGVO*/;
        header("Permissions-Policy: 'self'");
    @endphp

    <meta charset="utf-8">
    @if(config('app.debug'))
        <meta http-equiv="cache-control" content="max-age=0"> {{-- ONLY FOR DEVELOPEMENT --}}
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>

    <meta name="description" content="Hilfecenter der Sabine-Blindow Schulen">

    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register("{{ asset('js/serviceworker.js') }}");
        }
    </script>
    <script src="{{ asset('js/serviceworker.js') }}"></script>
    <link rel="icon" href="{{ asset("secure_dnt/logo.png") }}">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <script src="{{ asset("js/main.js") }}"></script>
    <livewire:styles />
    <livewire:scripts />


</head>

<body>
