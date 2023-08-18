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
    @livewireStyles
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
                            <a href="{{ route('learning.show', ['lesson' => $lesson->id]) }}" 
                                class="bg-white px-5 py-4 transition-colors hover:bg-gray-100 active:bg-green-200">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h4 class='text-base font-semibold'>
                                            {{ __('Lesson ') . ($index + 1) . ': ' . $lesson->title }}</h4>
                                        <p class="text">
                                            <i class="fa-solid fa-circle-play text-green-400"></i>
                                            {{ formatSeconds($lesson->duration) }}
                                        </p>
                                    </div>
                                    <div>
                                        <i class="fa-solid fa-circle-check text-green-400"></i>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="flex w-3/4 flex-col overflow-y-auto">
                        <div class="item-center mb-5 flex w-full justify-center bg-black">
                            <video class="w-full" controls>
                                <source src="{{ getMediaUrl('videos', $start_lesson->video) }}" type="video/mp4">
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
                                    <img class="h-8 w-8 rounded-full" src="{{ asset('images/avt.png') }}"
                                        alt="avatar">
                                @endif
                                <div class="font-medium dark:text-white">
                                    <div>{{ $teacher->name }}</div>
                                </div>
                            </div>

                            <p class="mt-5 text-lg">
                                {{ $start_lesson->description }}
                            </p>

                            @livewire('comment-section', ['lesson' => $start_lesson], key($start_lesson->id))

                            @livewireScripts
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
