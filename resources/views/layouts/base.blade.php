@props(['styles' => '', 'scripts' => ''])

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <script>
            window.config = {
                locale: "{{ config('app.locale') }}",
                host: "{{ request()->getSchemeAndHttpHost() }}"
            };            
        </script>        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        {{-- Globalne style CSS --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
       
        {{-- Lokalne style CSS --}}
        {{-- React cdn--}}

        {{ $styles }}
    </head>
    <body>
        
        {{ $slot }}
    </body>
    {{-- Globalne skrypty JS --}}
    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    {{-- Lokalne skrypty JS --}}
    {{ $scripts }} 
</html>