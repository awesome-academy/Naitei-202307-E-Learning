<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ env('APP_NAME') }}</title>
        
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>

    <body>
        <div id="app">
            <div class="flex-center full-height">
                @if (Route::has('login'))
                    <div class="top-right links w-full">
                        @auth
                            <header class="header bg-white shadow">
                                <nav class="nav mx-auto flex max-w-7xl items-center justify-between px-4 py-4">
                                    <a href="/"
                                        class="nav_logo mr-60 text-xl font-semibold text-black">{{ env('APP_NAME') }}</a>
                                    <div class="relative ml-16">
                                        <a
                                            hclass="button ml-12 px-8 py-4 text-xl bg-transparent border-2 text-black font-semibold
                                                cursor-pointer hover:bg-blue-400">
                                            <div class="flex cursor-pointer" id="drop-down-btn">
                                                @if (Auth::user()->avatar === null)
                                                    <img class="mr-2 h-8 w-8 rounded-3xl" src="{{ asset('images/avt.png') }}"
                                                        alt="avatar">
                                                @else
                                                    <img class="mr-2 h-8 w-8 rounded-3xl" src="{{ Auth::user()->avatar }}"
                                                        alt="avatar">
                                                @endif
                                                {{ Auth::user()->name }}
                                                <i class="fa-solid fa-caret-down ml-2 mt-1 justify-center text-center"></i>
                                            </div>

                                        </a>
                                        <div id="drop-down"
                                            class="absolute mt-4 hidden rounded border border-gray-300 bg-white shadow-md">
                                            <a href="/profile"
                                                class="block px-10 py-2 text-gray-800 hover:bg-gray-200">{{ __('Profile') }}</a>
                                            <a class="dropdown-item block px-10 py-2 text-gray-800 hover:bg-gray-200"
                                                href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </nav>
                            </header>
                        @else
                            <header class="header bg-white shadow">
                                <nav class="nav mx-auto flex max-w-7xl items-center justify-between px-4 py-2">
                                    <a href="/"
                                        class="nav_logo text-xl font-semibold text-black">{{ env('APP_NAME') }}</a>
                                    <a href="{{ route('login') }}"
                                        class="rounded-3xl bg-gradient-to-r from-green-400 to-blue-400 px-10 py-3 text-center font-semibold text-white hover:from-green-300 hover:to-blue-300">
                                        {{ __('Login') }}
                                    </a>
                                </nav>
                            </header>
                        @endauth
                    </div>
                @endif
                <main class="bg-emerald-300 py-4">
                    @yield('content')
                </main>
            </div>
    </body>
</html>
