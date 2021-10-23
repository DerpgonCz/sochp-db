<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header>
            @include('layouts.parts.header')
        </header>

        <main class="py-4">
            <div class="container-fluid">
                <div class="container">
                    @foreach(['success', 'danger', 'primary', 'info', 'warning'] as $alertType)
                        @if(session('flashes.' . $alertType))
                            @foreach(session()->pull('flashes.' . $alertType) as $flash)
                                @component('components.alert.' . $alertType) {{ $flash }} @endcomponent
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>

            @yield('content')
        </main>
    </div>
</body>
</html>
