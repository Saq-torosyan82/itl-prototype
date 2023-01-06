<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/includes.css') }}">

    </head>
    <body>
    <div id="wrapper" style="display:none;">
        <!-- Top Bar -->
    @include('layouts.topbar')

    <!-- Sidebar Nav -->
    @include('layouts.navigation')


    <!-- Page Content -->
    @yield('content')

    <!-- Footer -->
    @include('layouts.footer')
    </div>
    </body>

    <?php
        $reqPath       = Request::path();
        $documentPages = ['profile', 'resume'];
    ?>

    <!-- Scripts -->
    <script>var csrf_token = "{{ csrf_token() }}"</script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    @if(in_array($reqPath, $documentPages))
        <script src="{{ asset('js/documents.js') }}" defer></script>
    @endif
</html>
