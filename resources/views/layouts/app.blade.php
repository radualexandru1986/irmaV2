<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Irma</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="row m-0 p-0">
        @if(\Illuminate\Support\Facades\Auth::user())
            @include('layouts.navbar')
        @endif
    </div>
    <div class="row m-0 p-0">
        @include('layouts.left-bar')
        <div class="col-12 mx-auto" id="app">
            @yield('content')
        </div>
    </div>
    @stack('scripts')
</body>
</html>
