@extends('layouts.app')
<link href="{{ asset('css/font.css') }}" rel="stylesheet">
@section('content')
    <div class="mb-10 flex h-auto w-full p-5">
        <div class="ml-20 flex flex-1 p-10">
            <div>
                <p class="text-2xl font-semibold">{{ __('ReactJS') }}</p>
                <p class="mb-10 mt-5 text-lg">
                    {{ __('ReactJS is a JavaScript library for building user interfaces. It is maintained
                    by
                    Facebook and a community of individual developers and companies.') }}
                </p>

                <span class="text-2xl font-semibold">{{ __('Course Content') }}</span>
                <p>{{ __('4 Lessons • Duration 03 hours 25 minutes') }}</p>
                <div>
                    <ul class="ml-5 mt-10">
                        <a href="">
                            <li class="flex cursor-pointer items-center justify-between border-b-2 p-2 text-center">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-circle-play mr-2 text-green-500"></i>
                                    <p class="mr-2">{{ __('Lesson 1: ') }}</p>
                                    <p>{{ __('Introduction') }}</p>
                                </div>
                                <p>{{ __('10:35') }}</p>
                            </li>
                        </a>

                        <a href="">
                            <li class="flex cursor-pointer items-center justify-between border-b-2 p-2 text-center">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-circle-play mr-2 text-green-500"></i>
                                    <p class="mr-2">{{ __('Lesson 2: ') }}</p>
                                    <p>{{ __('Creating and nesting components') }}
                                    </p>
                                </div>
                                <p>{{ __('9:20') }}</p>
                            </li>
                        </a>

                        <a href="">
                            <li class="flex cursor-pointer items-center justify-between border-b-2 p-2 text-center">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-circle-play mr-2 text-green-500"></i>
                                    <p class="mr-2">{{ __('Lesson 3: ') }}</p>
                                    <p>{{ __('Writing markup with JSX') }}
                                    </p>
                                </div>
                                <p>{{ __('9:20') }}</p>
                            </li>
                        </a>

                        <a href="">
                            <li class="flex cursor-pointer items-center justify-between border-b-2 p-2 text-center">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-circle-play mr-2 text-green-500"></i>
                                    <p class="mr-2">{{ __('Lesson 4: ') }}</p>
                                    <p>{{ __('Adding styles') }}
                                    </p>
                                </div>
                                <p>{{ __('9:20') }}</p>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>


        </div>
        <div class="flex flex-1 p-10">
            <div>
                <img class="h-2/3 w-full rounded-3xl object-cover" src="{{ asset('images/reactjs.jpg') }}" alt="">
                <div class="w-full text-center">
                    <button
                        class="mt-10 w-1/3 rounded-3xl bg-gradient-to-r from-green-400 to-blue-400 px-4 py-3 text-center font-semibold text-white hover:from-pink-500 hover:to-yellow-500">{{ __('Enroll') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
