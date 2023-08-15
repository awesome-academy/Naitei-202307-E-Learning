@extends('layouts.app')
<link href="{{ asset('css/font.css') }}" rel="stylesheet">

@section('content')
    <div class="mb-10 flex h-auto w-full p-5">

        <div class="ml-20 flex flex-1 p-10">
            <div class="w-full">
                <div class="flex justify-between">
                    <p class="text-2xl font-semibold">{{ $course->name }}</p>

                    @if (isAuthor($course->teacher_id))
                        @component('components.dropdown')
                            <li>
                                <a href="{{ route('courses.edit', ['course' => $course->id]) }}"
                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                    {{ __('Edit') }}
                                </a>
                            </li>
                            <li>
                                <form class="mb-0" action="{{ route('courses.destroy', $course->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="block w-full px-4 py-2 text-left text-gray-800 hover:bg-gray-100"
                                        id="course-delete-button">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </li>
                        @endcomponent
                    @endif
                </div>

                <p class="mb-10 mt-5 text-lg">
                    {{ $course->description }}
                </p>

                <div class="flex justify-between">
                    <span class="text-2xl font-semibold">{{ __('Course Content') }}</span>
                    <a class="text-green-500 hover:text-green-800" href="">
                        <i class="fa-solid fa-plus"></i>
                        {{ __('Add Lesson') }}
                    </a>

                </div>

                <p>{{ $course->lessons->count() . ' lessons' }}</p>
                <div class="w-full">
                    <ul class="mt-10">
                        @foreach ($course->lessons as $index => $lesson)
                            <li class="flex items-center justify-between border-b-2 p-2 text-center">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-circle-play mr-2 text-green-500"></i>
                                    <p class="mr-2">{{ __('Lesson ') . ($index + 1) . ': ' }}</p>
                                    <p>{{ $lesson->title }}</p>
                                </div>
                                <p>{{ __('11:20') }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>


        </div>
        <div class="flex flex-1 flex-col p-10">
            <img class="h-2/3 w-full rounded-3xl object-cover"
                src="{{ route('content.show', ['type' => 'images', 'fileName' => $course->image]) }}" alt="">
            <a href=""
                class="mx-auto mt-5 w-6/12 rounded-2xl bg-gradient-to-r from-green-400 to-blue-400 px-4 py-2 text-center font-bold text-white hover:from-green-300 hover:to-blue-300">
                {{ __('Enroll') }}
            </a>
        </div>
    </div>
@endsection
