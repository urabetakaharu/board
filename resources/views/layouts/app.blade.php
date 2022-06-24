<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '欲しいもの掲示板') }}</title>
    <link rel="shortcut icon" type="image/x-icon"  href="{{ asset('/favicon.ico') }}">

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
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <h3>欲しいもの掲示板</h3>
                    </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    
                    <div class="explanation">
                        <p style ="margin: 0 auto; width: 90px;">サイト説明</p>
                        <audio controls class="audio"src="https://api.su-shiki.com/v2/voicevox/audio/?key=S-66731508E4n-7&speaker=0&pitch=0&intonationScale=1&speed=1&text=%E6%AC%B2%E3%81%97%E3%81%84%E3%82%82%E3%81%AE%E3%82%92%E6%8A%95%E7%A8%BF%E3%81%99%E3%82%8B%E3%82%B5%E3%82%A4%E3%83%88%E3%81%A7%E3%81%99%E3%80%82%E3%81%A9%E3%81%86%E3%81%97%E3%81%A6%E3%82%82%E6%AC%B2%E3%81%97%E3%81%84%E3%82%82%E3%81%AE%E3%81%8C%E3%81%82%E3%82%8A%E3%81%BE%E3%81%97%E3%81%9F%E3%82%89%E3%80%81%E6%B0%97%E8%BB%BD%E3%81%AB%E6%8A%95%E7%A8%BF%E3%81%97%E3%81%A6%E3%81%BF%E3%81%A6%E3%81%8F%E3%81%A0%E3%81%95%E3%81%84%EF%BC%81"></audio>
                    </div>
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </main>
    <footer class="footer">
        <div class="container">
            <p class="text-muted">VOICEVOX:四国めたん</p>
        </div>
    </footer>
    </div>
</body>
</html>
