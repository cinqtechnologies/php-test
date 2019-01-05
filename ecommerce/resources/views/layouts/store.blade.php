<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'App') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    @stack('styles')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('scripts')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#">{{ config('app.name', 'App') }}</a>
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    @auth
                    <a class="nav-item nav-link active" href="{{ url('/dashboard') }}">Home</a>
                    @else
                        <a  class="nav-item nav-link"href="{{ route('login') }}">Login</a>

                        <a  class="nav-item nav-link"href="{{ route('register') }}">Register</a>
                        @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @include('partials.loading')

        <div v-show="!pageLoading" id="main-content" style="display: none">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>