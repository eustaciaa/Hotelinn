<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Icon -->
    <link rel="icon" href="{{ asset('images/hotelinn/logo_circle.png') }}">
</head>
<body>
<script>
$('.dropdown-toggle').on("click", function(e) {
    e.stopPropagation();
    e.preventDefault();
    $(this).next('.dropdown-menu').toggle();
});
</script>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white sticky-top shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    <img src="{{ asset('images/hotelinn/brand.png') }}" width="100" height="100%" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Masuk') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Daftar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->fName }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                

                                <a class="dropdown-item dropdown-toggle" type="button" data-toggle="dropdown">
                                        {{ __('Ubah Profil') }}
                                    <ul class="dropdown-menu">
                                        <a class="dropdown-item" onclick="event.preventDefault();document.getElementById('profile-form').submit();">{{ __('Second level') }}</a>
                                    </ul>
                                </a>    
                                    <form id="profile-form" action="/profile" method="POST" style="display: none;">
                                        @csrf
                                    </form>


                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item"
                                       onclick="event.preventDefault();
                                                     document.getElementById('history-form').submit();">
                                        {{ __('Riwayat Pemesanan') }}
                                    </a>
                                    <form id="history-form" action="/history" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Keluar') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="pb-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
