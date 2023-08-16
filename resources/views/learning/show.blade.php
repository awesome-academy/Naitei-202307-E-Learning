<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ 'Learning | ' . env('APP_NAME') }}</title>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/localization.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link href="{{ asset('css/library.css') }}" rel="stylesheet">
    <link href="{{ asset('css/learning.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <div class="flex h-screen flex-col overflow-hidden">
            @if (Route::has('login'))
                <div class="top-right links w-full">
                    <header class="header bg-gray-700 bg-white shadow">
                        <nav class="mx-auto flex max-w-full items-center justify-between px-10 py-2">
                            <a href="{{ route('courses.show', ['course' => $course->id]) }}"
                                class="text-white hover:text-gray-300">
                                <i class="fa-solid fa-chevron-left mr-2"></i>
                                {{ __('Back') }}
                            </a>

                            <div class="flex items-center gap-2">
                                <div x-data="{ percent: {{ 50 }}, circumference: 2 * Math.PI * 20 }"
                                    class="inline-flex items-center justify-center overflow-hidden rounded-full">
                                    <svg class="h-10 w-10">
                                        <circle class="text-gray-300" stroke-width="3" stroke="currentColor"
                                            fill="transparent" r="18" cx="20" cy="20" />
                                        <circle class="text-green-400" stroke-width="3"
                                            :stroke-dasharray="circumference"
                                            :stroke-dashoffset="circumference - percent / 100 * circumference"
                                            stroke-linecap="round" stroke="currentColor" fill="transparent"
                                            r="18" cx="20" cy="20" />
                                    </svg>
                                    <span class="absolute text-sm text-green-500" x-text=`{{ __('50') }}%`></span>
                                </div>

                                <div class="text-white">
                                    <span>{{ __('2/12') }}</span>
                                </div>
                            </div>
                        </nav>
                    </header>
                </div>
            @endif
            <main class="learning-content bg-emerald-300">
                <div class="flex h-full">
                    <div class="flex w-1/4 flex-col divide-y divide-dashed overflow-y-auto bg-gray-100">
                        @foreach ($course->lessons as $index => $lesson)
                            <div
                                class="flex cursor-pointer items-center justify-between bg-white px-5 py-4 transition-colors hover:bg-gray-100 active:bg-green-200">
                                <a href="{{ route('learning.show', ['lesson' => $lesson->id]) }}">
                                    <h4 class='text-base font-semibold'>{{ __('Lesson ') . ($index + 1) . (': ') . ($lesson->title) }}</h4>
                                    <p class="text">
                                        <i class="fa-solid fa-circle-play text-green-400"></i>
                                        {{ formatSeconds($lesson->duration) }}
                                    </p>
                                </a>
                                <div class="">
                                    <i class="fa-solid fa-circle-check text-green-400"></i>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex w-3/4 flex-col overflow-y-auto">
                        <div class="item-center mb-5 flex w-full justify-center bg-black">
                            <video class="w-full" controls>
                                <source
                                    src="{{ route('content.show', ['type' => 'videos', 'fileName' => $start_lesson->video]) }}"
                                    type="video/mp4">
                                {{ __('Your browser does not support the video tag.') }}
                            </video>
                        </div>

                        <div class="px-12 py-6">
                            <div class="flex justify-between">
                                <p class="text-2xl font-semibold">{{ $start_lesson->title }}</p>
                            </div>

                            <div class="mt-5 flex items-center space-x-4">
                                @if ($teacher->avatar !== null)
                                    <img class="h-8 w-8 rounded-full" src="{{ $teacher->avatar }}" alt="avatar">
                                @else
                                    <img class="h-8 w-8 rounded-full" src="{{ asset('images/avt.png') }}" alt="avatar">
                                @endif
                                <div class="font-medium dark:text-white">
                                    <div>{{ $teacher->name }}</div>
                                </div>
                            </div>

                            <p class="mt-5 text-lg">
                                {{ $start_lesson->description }}
                            </p>

                            <div class="mt-10 bg-white">
                                <div class="mb-6 flex items-center justify-between">
                                    <h2 class="text-lg font-bold text-gray-900 dark:text-white lg:text-2xl">
                                        {{ __('Discussion (20)') }}</h2>
                                </div>

                                <form class="mb-6">
                                    <div class="mb-4 rounded-lg rounded-t-lg border border-gray-200 bg-white px-4 py-2">
                                        <textarea id="comment" rows="4"
                                            class="w-full border-0 px-0 text-sm text-gray-900 focus:outline-none focus:ring-0 dark:bg-gray-800"
                                            placeholder="{{ __('Write a comment...') }}"></textarea>
                                    </div>
                                    <button
                                        class="rounded-2xl bg-gradient-to-r from-green-400 to-blue-400 px-3 py-2 text-center font-bold text-white hover:from-green-300 hover:to-blue-300">
                                        {{ __('Post Comment') }}
                                    </button>
                                </form>


                                <article class="mb-6 rounded-lg bg-white text-base dark:bg-gray-900">
                                    <footer class="mb-2 flex items-center justify-between">
                                        <div class="flex items-center">
                                            <p
                                                class="mr-3 inline-flex items-center text-sm text-gray-900 dark:text-white">
                                                <img class="mr-2 h-6 w-6 rounded-full"
                                                    src="{{ asset('images/avt.png') }}"
                                                    alt="avatar">{{ __('Michael Gough') }}</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate
                                                    datetime="2022-02-08"
                                                    title="February 8th, 2022">{{ __('Feb. 8, 2022') }}</time></p>
                                        </div>
                                        <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                                            class="inline-flex items-center rounded-lg bg-white p-2 text-center text-sm font-medium text-gray-400 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                            type="button">
                                            <svg class="h-5 w-5" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                                </path>
                                            </svg>
                                        </button>

                                        <div id="dropdownComment1"
                                            class="z-10 hidden w-36 divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="dropdownMenuIconHorizontalButton">
                                                <li>
                                                    <a href="#"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Edit') }}</a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Remove') }}</a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Report') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </footer>
                                    <p class="text-gray-500 dark:text-gray-400">
                                        {{ __('Very straight-to-point article. Really worth time reading. Thank you! But tools are just the
                                            instruments for the UX designers. The knowledge of the design tools are as important as the
                                            creation of the design strategy.') }}
                                    </p>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
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
