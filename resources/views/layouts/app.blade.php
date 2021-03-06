<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icon -->
    <link rel="shortcut icon" href="{{ asset('paper/img/favicon.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('paper/img/apple-icon.png') }}">

    <!-- Social Tags -->
    <meta name="keywords" content="covid, corona, bootstrap 4 dashboard, laravel">
    <meta name="description" content="Covid-19 Tracker app by group 8">

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Covid-19 tracker app by group 8">
    <meta itemprop="description" content="This is app is using for tracking covid-19 disease, development with a bootstrap 4 Admin Dashboard built for Laravel Framework">
    <meta itemprop="image" content="{{ asset('paper/img/covid-19.jpg') }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@covidTrackerApp">
    <meta name="twitter:title" content="Covid Tracker app Laravel by group 8">
    <meta name="twitter:description" content="This is app is using for tracking covid-19 disease, development with a bootstrap 4 Admin Dashboard built for Laravel Framework.">
    <meta name="twitter:creator" content="@Group8">
    <meta name="twitter:image" content="{{ asset('paper/img/covid-19.jpg') }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="Covid Tracker app Laravel by group 8" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://www.creative-tim.com/live/paper-dashboard-laravel" />
    <meta property="og:image" content="{{ asset('paper/img/covid-19.jpg') }}"/>
    <meta property="og:description" content="This is app is using for tracking covid-19 disease, development with a bootstrap 4 Admin Dashboard built for Laravel Framework." />
    <meta property="og:site_name" content="Covid Tracker App" />

    <title>{{ config('app.name', 'Covid Tracker App') }}</title>

    {{-- JQuery --}}
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Styles -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('paper/css/paper-dashboard.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>

    <div class="mx-auto">
        @include('shared.app.navbar')
        <main class="py-4" id="app">
            @yield('content')
        </main>
        @include('shared.app.footer')
        <a id="back-to-top" href="#" class="btn btn-light btn-md back-to-top text-center" role="button">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <script src="{{ asset('plugins/popper/popper.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/chart-js/chartjs.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('paper/js/paper-dashboard.min.js?v=2.0.0') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/login.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')

</body>
</html>
