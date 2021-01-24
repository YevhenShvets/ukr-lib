<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Inter" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <div id="app">
        <div class="container">
            <nav class="navbar navbar-expand-md main-navbar">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('img/logo.png') }}" style="width:60px; height:60px;" alt="Logo">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item menu_item">
                                <a class="nav-link text-black" href="{{ route('authors') }}">Автори</a>
                            </li>
                            <li class="nav-item menu_item">
                                <a class="nav-link text-black" href="{{ route('texts') }}">Твори</a>
                            </li>
                            <li class="nav-item menu_item">
                                <a class="nav-link text-black" href="{{ route('popular') }}">Популярні</a>
                            </li>
                            @auth('web')
                                <li class="nav-item menu_item bg-warning">
                                    <a class="nav-link text-black text-dark" href="{{ route('mypage') }}">Моя сторінка</a>
                                </li>
                            @endauth
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link text-black" href="{{ route('login') }}">{{ __('Авторизація') }}</a>
                                    </li>
                                @endif
                                
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link text-black" href="{{ route('register') }}">{{ __('Реєстрація') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Вихід') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </div>


        @auth('admin')
            <div class="align-items-center admin">
                <a href="{{ route('adminHome') }}" class="btn btn-warning">Головне меню</a>
                <a href="{{ route('adminAddAuthor') }}" class="btn btn-dark btn-sm mt-2">Форма для добавлення автора</a>
                <a href="{{ route('adminAddText') }}" class="btn btn-dark btn-sm mt-1">Форма для добавлення твору</a>
                <a href="{{ route('adminLogout') }}" class="btn btn-danger btn-sm mt-3">Вихід</a>
            </div>
        @endauth

        <main class="mt-4">
            @yield('content')
        </main>

        <footer>
            <div class="text-center">
                2021
            </div>
        </footer>
    </div>
</body>
</html>
