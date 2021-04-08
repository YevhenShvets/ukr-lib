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
                        <img src="{{ asset('favicon.ico') }}" style="width:60px; height:60px;" alt="Logo">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item menu_item">
                                <a class="nav-link text-black" href="{{ route('home') }}">Головна</a>
                            </li>
                            <li class="nav-item menu_item">
                                <a class="nav-link text-black" href="{{ route('authors') }}">Автори</a>
                            </li>
                            <li class="nav-item menu_item">
                                <a class="nav-link text-black" href="{{ route('texts') }}">Твори</a>
                            </li>
                            <li class="nav-item menu_item">
                                <a class="nav-link text-black" href="{{ route('contacts') }}">Контакти</a>
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
            <div class="align-items-center admin" style="width:280px; z-index:1;">
                <a href="{{ route('adminHome') }}" class="btn btn-warning" style="display:block;">Головне меню</a>
                <hr style="background-color:green;">
                <div id="hoverShow1">
                    <div style="display:flex; justify-content:center;">
                        <a href="{{ route('adminAddAuthor') }}" class="btn btn-dark btn-sm">Добавлення автора</a>
                        <a href="{{ route('adminDeleteAuthor') }}" class="btn btn-danger btn-sm">Вилучення автора</a>
                    </div>
                    <div>
                        <a href="{{ route('adminAddTextType') }}" class="btn btn-info btn-sm mt-3">Добавлення / Вилучення типу твору</a>
                    </div>
                    <div class="mt-3" style="display:flex; justify-content:center;">
                        <a href="{{ route('adminAddText') }}" class="btn btn-dark btn-sm">Добавлення твору</a>
                        <a href="{{ route('adminDeleteText') }}" class="btn btn-danger btn-sm">Вилучення твору</a>
                    </div>
                    <div>
                        <a href="{{ route('adminAddContact') }}" class="btn btn-info btn-sm mt-3">Добавлення контакту</a>
                    </div>
                </div>
                <hr style="background-color:green;">
                <a href="{{ route('adminLogout') }}" class="btn btn-danger btn-sm mt-3">Вихід</a>
            </div>
        @endauth

        <main class="mt-4">
            @yield('content')
        </main>
        <footer class="">
            <div class="text-center">
                2021 Всі права захищено
            </div>
            <div class="text-center" style="padding:10px;">
            <a href="https://twitter.com/GOB5aVvlj7AosJi" target="_blank" style="color:#119afb;">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                </svg>
            </a>
            <a href="https://youtube.com/channel/UCy4K9RqgCRqfj_xNmFW7DcA" target="_blank" style="color:#ce1a19;">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                    <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                </svg>
            </a>
            <a href="https://www.facebook.com/groups/961284024678190/?ref=share" target="_blank" style="color:#077ae9;">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                </svg>
            </a>
            </div>
        </footer>
    </div>
</body>
</html>
