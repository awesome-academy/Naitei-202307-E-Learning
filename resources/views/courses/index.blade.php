@extends('layouts.app')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">

@section('content')
    <div class="mx-14 mt-10 flex justify-between">
        <h2 class="mb-2 text-2xl font-bold">{{ $courses->count() . ' Results' }}</h2>
        @auth
            @if (auth()->user()->isTeacher())
                <a href="{{ route('courses.create') }}"
                    class="rounded-2xl bg-gradient-to-r from-green-400 to-blue-400 px-4 py-2 text-center font-bold text-white hover:from-green-300 hover:to-blue-300">
                    {{ __('Create Course') }}
                </a>
            @endif
        @endauth
    </div>
    <div class="cards ml-10 mr-10 mt-10">
        @foreach ($courses as $course)
            <div class="card" href="">
                <a href="{{ route('courses.show', ['course' => $course->id]) }}">
                    <img src="{{ getMediaUrl('images' ,$course->image) }}"
                        alt="" class="card-image" />
                </a>
                <div class="card-content">
                    <div class="card-top">
                        <a href="{{ route('courses.show', ['course' => $course->id]) }}">
                            <h1 class="card-title">{{ $course->name }}</h1>
                        </a>
                        <p class="card-content mb-5">
                            {{ $course->description }}
                        </p>
                        <div class="card-user">
                            <img src="{{ $course->user->avatar }}"
                                alt="" class="card-user-avatar" />
                            <div class="card-user-info">
                                <div class="card-user-top">
                                    <h4 class="card-user-name">{{ $course->user->name }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-bottom">
                        <div class="card-watching">{{ $course->enrolled_count . ' Enrolled' }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mx-14 mt-8 flex justify-end">
        {{ $courses->links('pagination::tailwind') }}
    </div>
@endsection
