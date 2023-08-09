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
                                <nav class="nav max-w-7xl mx-auto px-4 py-4 flex items-center justify-between ">
                                    <a href="/" class="nav_logo text-black font-semibold text-xl mr-60">{{ env('APP_NAME') }}</a>
                                    <div class="relative ml-16">
                                        <a hclass="button ml-12 px-8 py-4 text-xl bg-transparent border-2 text-black font-semibold
                                        cursor-pointer hover:bg-blue-400">
                                            <div class="flex cursor-pointer" id="drop-down-btn" >
                                                <img class=" mr-2 w-6 h-6" src="{{Auth::user()->avatar}}" alt="avatar">    
                                                {{Auth::user()->name}}
                                                <i class="ml-2 text-center mt-1 justify-center fa-solid fa-caret-down"></i>
                                            </div>
                                            
                                        </a>
                                        <div id="drop-down" class="absolute mt-4 hidden bg-white border border-gray-300 rounded shadow-md">
                                            <a href="/profile" class="block px-10 py-2 text-gray-800 hover:bg-gray-200">{{ __('Profile') }}</a>
                                            <a class="dropdown-item block px-10 py-2 text-gray-800 hover:bg-gray-200" href="{{route('logout')}}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </nav>
                            </header>
                        @else
                            <header class="header bg-white shadow">
                                <nav class="nav max-w-7xl mx-auto px-4 py-2 flex items-center justify-between">
                                    <a href="/" class="nav_logo text-black font-semibold text-xl">{{ env('APP_NAME') }}</a>
                                    <a href="{{ route('login') }}" class="button  ml-12 px-8 py-2 text-xl bg-transparent  text-black font-semibold
                                    rounded-2xl cursor-pointe hover:text-green-300">
                                        Login
                                    </a>
                                </nav>
                            </header>
                        @endauth
                    </div>
                @endif
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
</html>
