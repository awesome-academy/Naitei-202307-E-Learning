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
        <link href="{{ asset('css/landingpage.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/font.css') }}">

    </head>

    <body>
        <div id="app">
            <div class="flex-center full-height">
                @if (Route::has('login'))
                    <div class="top-right links w-full">
                        <header class="header fixed w-full bg-white shadow">
                            <nav class="mx-auto flex max-w-full items-center justify-between px-10 py-4">
                                <a href="/" class="nav_logo flex items-center text-xl font-semibold text-black">
                                    <img class="cover-fill mr-5 h-14 w-14 rounded-lg" src="{{ asset('images/logo.png') }}"
                                        alt="">
                                    <p>{{ env('APP_NAME') }}</p>
                                </a>
                                <a href="{{ route('home') }}">
                                    <p class="text-lg">{{ __('Course') }}</p>
                                </a>
                                <div class="search-input flex items-center">
                                    <div class="relative">
                                        <i
                                            class="fa-xl fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 transform text-blue-400"></i>
                                        <input type="text" id="name"
                                            class="w-96 rounded-3xl border py-2 pl-10 focus:border-green-500 focus:outline-none"
                                            placeholder="{{ __('Enter name of courses') }}" name="name"
                                            value="{{ old('name') }}">
                                        <button type="button"
                                            class="absolute right-2 top-1/2 -translate-y-1/2 transform rounded-3xl bg-gradient-to-tr from-green-400 to-blue-400 px-5 py-1 text-center text-white hover:from-green-300 hover:to-blue-300">
                                            {{ __('Find') }}
                                        </button>
                                    </div>
                                </div>

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

                                @auth
                                    <div class="relative ml-16">

                                        <div class="flex cursor-pointer items-center text-center" id="drop-down-btn">
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
                <div class="px-50 flex h-auto rounded-b-3xl bg-green-100 py-40">
                    <div class="h-24 flex-row px-24 py-10">
                        <div class="flex-1">
                            <h2 class="mt-20 text-4xl font-bold text-[#2f327d]">
                                {{ __('Studying Online is now much easier') }}
                            </h2>
                        </div>
                        <div class="flex-1 py-20">
                            <h2 class="text-lg">
                                {{ env('APP_NAME') }}
                                {{ __(' is an interesting platform that will teach you in more an interactive way') }}
                            </h2>
                        </div>
                        <div class="flex flex-1">
                            <div class="flex-1">
                                <a href="{{ route('login') }}"
                                    class="rounded-3xl bg-gradient-to-r from-green-400 to-blue-400 px-10 py-3 text-center text-xl font-bold text-white hover:from-green-300 hover:to-blue-300">
                                    {{ __('Join for free') }}
                                </a>
                            </div>

                            <div class="float-right flex-1 text-right text-2xl">
                                <i class="fa-xl fa-sharp fa-solid fa-circle-play" style="color: #ee2f2f;">
                                </i>
                                <span>{{ __('Watch video') }}</span>
                            </div>

                        </div>
                    </div>
                    <div class="cover-fill h-1/2 w-1/2 px-20">
                        <img src="{{ asset('images/introduction.png') }}" alt="">
                    </div>
                </div>
                <div class="mx-80 pt-28 text-center leading-10">
                    <h1 class="my-10 text-center text-4xl font-semibold text-blue-900">{{ __('What is E-Learning?') }}</h1>
                    <p class="text-2xl font-medium text-gray-600">
                        {{ env('APP_NAME') }}
                        {{ __(' is a platform that allows educators to create online classes
                                whereby they can store the course materials online; manage assignments, quizzes and exams;
                                monitor due dates; grade results and provide students with feedback all in one place.') }}
                    </p>
                </div>
                <div class="mx-10 mt-5 flex h-auto items-center py-36 text-center">
                    <div class="teacher mx-20 flex-1 rounded-3xl cover-fill py-28">
                        <h3 class="text-white font-bold rounded-3xl my-12 text-2xl">{{ __('FOR TEACHERS') }}</h3>
                        <a href="{{ route('teacher.create') }}"
                            class=" border rounded-3xl bg-gradient-to-r to-blue-400 px-10 py-5 text-center text-xl font-bold text-white  hover:from-green-300 hover:to-blue-300">
                            {{ __('Start a class today') }}
                        </a>
                    </div>
                    <div class="student mx-20 flex-1 rounded-3xl cover-fill py-28">
                        <h3 class="text-white font-bold rounded-3xl my-12 text-2xl">{{ __('FOR STUDENTS') }}</h3>
                        <a href="{{ route('login') }}"
                            class=" border rounded-3xl bg-gradient-to-r to-blue-400 px-10 py-5 text-center text-xl font-bold text-white  hover:from-green-300 hover:to-blue-300">
                            {{ __('Learn courses now') }}
                        </a>
                    </div>
                </div>
                
                <div class=" footer text-bold flex-row items-center justify-center bg-gray-600 px-40 pb-10 pt-14 text-2xl text-white">
                    <div class="flex">
                        <div class="flex flex-1 items-center justify-end px-16 text-center">
                            <img class="mr-3 h-14 w-14" src="{{ asset('images/logo.png') }}" alt="">
                            {{ env('APP_NAME') }}
                        </div>
                        <div class="text-gray-120 text-4xl">
                            <p class="flex h-16 items-center border-r border-white pr-4"></p>
                        </div>
                        <div class="flex flex-1 px-6 text-xl">
                            <p class="w-1/3">{{ __('Online courses for evvery one') }}</p>
                        </div>
                    </div>
                    <div class="mt-16 text-xl flex items-center justify-center text-gray-300">
                        <p>{{ __('Subscribe to get our Newsletter') }}</p>
                    </div>
                    <div class="flex text-gray-300 items-center justify-center py-5">
                        <div class="flex flex-1 justify-end text-right items-end px-5 ml-40">
                            <input type="email" id="email" class="border-gray-50 bg-gray-600 text-sm focus:border-green-500 focus:outline-none border rounded-3xl px-6 w-3/5 py-2" placeholder="{{ __('Your mail') }}" name="email">
                        </div>
                        <div class="flex-1 px-5 text-left">
                            <a href=""
                                class="rounded-3xl bg-gradient-to-r from-green-400 to-blue-400 px-6 py-2 text-center text-xl font-semibold text-white hover:from-green-300 hover:to-blue-300">
                                {{ __('Subscribe') }}
                            </a>
                        </div>
                    </div>
                    <div class="flex text-gray-300 px-16 text-xl items-center text-center justify-center mt-10">
                        <i class="fa-regular fa-copyright ml-5" style="color: #cfd0d3;"></i>
                        <p>{{ __('2023 I do not write code. All Rights Reserved') }}</p>
                    </div>             
                </div>
            </div>
    </body>
</html>
