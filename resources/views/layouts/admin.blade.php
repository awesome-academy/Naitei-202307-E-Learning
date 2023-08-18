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
    <div id="admin" class="flex h-screen flex-col bg-gray-100">
        <nav
            class="flex w-full flex-wrap items-center justify-between border-b border-gray-200 bg-white p-4 p-4 md:top-0 md:z-20">
            <a href="/" class="nav_logo flex items-center text-xl font-semibold text-black">
                <img class="cover-fill mr-5 h-10 w-10 rounded-lg" src="{{ asset('images/logo.png') }}" alt="">
                <p>{{ env('APP_NAME') }}</p>
            </a>

            <div class="flex">
                <div class="localization">
                    <select name="localization" id="lang" onchange="changeLocale(this.value)">
                        <option value="vi" {{ App::getLocale() === 'vi' ? 'selected' : '' }}>
                            {{ __('VI') }}
                        </option>
                        <option value="en" {{ App::getLocale() === 'en' ? 'selected' : '' }}>
                            {{ __('EN') }}
                        </option>
                    </select>
                </div>

                <div class="relative ml-16">
                    <div class="flex cursor-pointer items-center text-center" id="drop-down-btn">
                        <img class="mr-2 h-8 w-8 rounded-3xl" src="{{ Auth::user()->avatar }}" alt="avatar">
                        {{ Auth::user()->name }}
                        <i class="fa-solid fa-caret-down ml-2 mt-1 justify-center text-center"></i>
                    </div>

                    <div id="drop-down" class="absolute mt-4 hidden rounded border border-gray-300 bg-white shadow-md">
                        <a href="/profile" class="block px-10 py-2 text-gray-800 hover:bg-gray-200">
                            {{ __('Profile') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            <button class="dropdown-item block px-10 py-2 text-gray-800 hover:bg-gray-200"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex flex-grow">
            <aside class="w-1/6 border-gray-300 bg-white px-3 py-4">
                <ul>
                    <a class="{{ request()->routeIs('admin.index') ? 'text-white' : 'text-green-500 hover:text-green-700' }}"
                        href="{{ route('admin.index') }}">
                        <li class="{{ request()->routeIs('admin.index') ? 'bg-green-400' : '' }} mb-2 rounded-xl p-3">
                            <i class="fa-solid fa-house mr-2 w-5"></i>
                            {{ __('Dashboard') }}
                        </li>
                    </a>
                    <a class="{{ request()->routeIs('admin.teachers') ? 'text-white' : 'text-green-500 hover:text-green-700 hover:text-green-700' }}"
                        href="{{ route('admin.teachers') }}">
                        <li
                            class="{{ request()->routeIs('admin.teachers') ? 'bg-green-400' : 'hover:bg-gray-100' }} mb-2 rounded-xl p-3">
                            <i class="fa-solid fa-graduation-cap mr-2 w-5"></i>
                            {{ __('Teachers') }}
                        </li>
                    </a>
                    <a class="{{ request()->routeIs('admin.users') ? 'text-white' : 'text-green-500 hover:text-green-700' }}"
                        href="{{ route('admin.users') }}">
                        <li
                            class="{{ request()->routeIs('admin.users') ? 'bg-green-400' : 'hover:bg-gray-100' }} mb-2 rounded-xl p-3">
                            <i class="fa-solid fa-user mr-2 w-5"></i>
                            {{ __('Users') }}
                        </li>
                    </a>
                    <a class="{{ request()->routeIs('admin.categories') ? 'text-white' : 'text-green-500 hover:text-green-700' }}"
                        href="{{ route('admin.categories') }}">
                        <li
                            class="{{ request()->routeIs('admin.categories') ? 'bg-green-400' : 'hover:bg-gray-100' }} mb-2 rounded-xl p-3">
                            <i class="fa-solid fa-bars mr-2 w-5"></i>
                            {{ __('Category') }}
                        </li>
                    </a>
                </ul>
            </aside>

            <main class="m-6 w-5/6 rounded-xl bg-white px-10 py-4">
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
