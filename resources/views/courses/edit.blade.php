@extends('layouts.app')
<link href="{{ asset('css/font.css') }}" rel="stylesheet">
@section('content')
    <div class="h-screen bg-gradient-to-r from-green-300 via-blue-400 to-blue-300">
        <form action="{{ route('courses.update', ['course' => $course->id]) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="flex h-screen flex-col px-40 pt-28">
                <div class="flex">
                    <div class="w-full rounded-2xl bg-white p-8">
                        <div class="mb-4">
                            <label for="name" class="mb-2 block font-bold text-gray-700">{{ __('Course Name') }}</label>
                            <input type="text"
                                class="w-full rounded-2xl border px-3 py-2 focus:border-green-500 focus:outline-none"
                                placeholder="Enter course name" name="name"
                                value="{{ $course->name }}" autocomplete="name">
                            @error('name')
                                <span class="mt-1 text-sm text-red-400" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description"
                                class="mb-2 block font-bold text-gray-700">{{ __('Description') }}</label>
                            <textarea type="text" class="w-full rounded-2xl border px-3 py-2 focus:border-green-500 focus:outline-none"
                                placeholder="Enter course description"
                                name="description" rows=4>{{ $course->description }}</textarea>
                            @error('description')
                                <span class="mt-1 text-sm text-red-400" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="mb-2 block font-bold text-gray-700">{{ __('Image') }}</label>
                            <input
                                class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400"
                                name="image" type="file">
                            @error('image')
                                <span class="mt-1 text-sm text-red-400" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4 flex justify-end">
                            <button
                                class="rounded-2xl bg-gradient-to-r from-green-400 to-blue-400 px-3 py-2 text-center font-bold text-white hover:from-green-300 hover:to-blue-300">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
