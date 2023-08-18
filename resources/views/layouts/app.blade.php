<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ env('APP_NAME') }}</title>
        <script src="{{ asset('js/main.js') }}" defer></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/localization.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/font.css') }}">
        <link href="{{ asset('css/library.css') }}" rel="stylesheet">

    </head>

    <body>
        <div id="app">
            <div class="flex-center full-height min-h-screen">
                @if (Route::has('login'))
                    <div class="top-right links w-full fixed">
                        <header class="header bg-white shadow">
                            <nav class="mx-auto flex max-w-full items-center justify-between px-10 py-4">
                                <a href="/" class="nav_logo flex items-center text-xl font-semibold text-black">
                                    <img class="cover-fill mr-5 h-10 w-10 rounded-lg" src="{{ asset('images/logo.png') }}"
                                        alt="">
                                    <p>{{ env('APP_NAME') }}</p>
                                </a>
                                <a href="{{ route('courses.index') }}">
                                    <p class="text-lg">{{ __('Course') }}</p>
                                </a>
                                <form action="{{ route('search') }}" method="POST" class="m-0">
                                    @csrf
                                    <div class="search-input flex items-center">
                                        <div class="relative">
                                            <i
                                                class="fa-xl fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 transform text-blue-400"></i>
                                            <input type="text" id="name"
                                                class="w-96 rounded-3xl border py-2 pl-10 focus:border-green-500 focus:outline-none"
                                                placeholder="{{ __('Enter name of courses') }}" name="name"
                                                value="{{ old('name') }}">
                                            <button type="submit"
                                                class="absolute right-2 top-1/2 -translate-y-1/2 transform rounded-3xl bg-gradient-to-tr from-green-400 to-blue-400 px-5 py-1 text-center text-white hover:from-green-300 hover:to-blue-300">
                                                {{ __('Find') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <div class="localization">
                                    <select name="localization" id="lang" onchange="changeLocale(this.value)"
                                            class="border bg-white rounded-md p-2 focus:outline-none focus:ring focus:border-green-300">
                                        <option value="vi" {{ App::getLocale() === 'vi' ? 'selected' : '' }}>
                                            {{ __('VI') }}
                                        </option>
                                        <option value="en" {{ App::getLocale() === 'en' ? 'selected' : '' }}>
                                            {{ __('EN') }}
                                        </option>
                                    </select>
                                </div>

                                @auth
                                    <div class="relative ml-16">

                                        <div class="flex cursor-pointer items-center text-center" id="drop-down-btn">
                                            <img class="mr-2 h-8 w-8 rounded-3xl" src="{{ Auth::user()->avatar }}"
                                                    alt="avatar">
                                            {{ Auth::user()->name }}
                                            <i class="fa-solid fa-caret-down ml-2 mt-1 justify-center text-center"></i>
                                        </div>

                                        <div id="drop-down"
                                            class="absolute mt-4 hidden rounded border border-gray-300 bg-white shadow-md">
                                            <a href="/profile" class="block px-10 py-2 text-gray-800 hover:bg-gray-200">
                                                {{ __('Profile') }}
                                            </a>
                                            @if (Auth::user()->isAdmin())
                                                <a href="{{ route('admin.index') }}"
                                                    class="block px-10 py-2 text-gray-800 hover:bg-gray-200">
                                                    {{ __('Admin') }}
                                                </a>
                                            @endif
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                                <button class="dropdown-item block px-10 py-2 text-gray-800 hover:bg-gray-200"
                                                    onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="rounded-3xl bg-gradient-to-r from-green-400 to-blue-400 px-10 py-2 text-center font-bold text-white hover:from-green-300 hover:to-blue-300">
                                        {{ __('Login') }}
                                    </a>
                                @endauth
                            </nav>
                        </header>
                    </div>
                @endif
                <main class="bg-emerald-300 pt-16">
                    @yield('content')
                </main>

                @if (session()->has('success'))
                    <script>
                        window.addEventListener('load', function() {
                            toastr.success('{{ session('success') }}');
                        });
                    </script>
                @endif

                @if (session()->has('error'))
                    <script>
                        window.addEventListener('load', function() {
                            toastr.error('{{ session('error') }}');
                        });
                    </script>
                @endif
            </div>
    </body>
</html>
