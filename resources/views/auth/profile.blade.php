@extends('layouts.app')
<link href="{{ asset('css/font.css') }}" rel="stylesheet">
@section('content')
    <div class="h-screen bg-gray-100">
        <form method="POST" action="{{ route('profile.update') }}" class="flex justify-center gap-5"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mt-16 flex flex-col rounded-3xl bg-white py-4 px-10">
                <div class="flex justify-center">
                    <img src="{{ $user->avatar }}" alt="profile" class="h-44 w-44 rounded-full object-cover">
                </div>
                <div class="mt-4 flex justify-center">
                    <input type="file" name="avatar" id="updateAvatar" style="display: none;" />
                    <input type="button" value="{{ __('Update') }}"
                        class="rounded-xl bg-green-400 px-3 py-1 text-sm font-bold text-white hover:bg-green-300"
                        onclick="document.getElementById('updateAvatar').click();" />
                    @error('image')
                        <span class="text-sm text-red-400" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <h2 class="bg-white py-4 text-center text-xl font-bold">{{ $user->name }}</h2>

            </div>
            <div class="mt-16 rounded-3xl bg-white p-5">
                <div class="flex flex-col">
                    <div class="flex rounded-3xl">
                        <div class="w-1/2 pl-14 pr-10 pt-5">
                            <div class="mb-4">
                                <label for="email" class="mb-2 block font-bold text-gray-700">{{ __('Email') }}</label>
                                <input type="email" id="email"
                                    class="w-full rounded-2xl border px-3 py-2 focus:border-green-500 focus:outline-none"
                                    placeholder="{{ __('Enter your email') }}" @error('email') bg-red-700 @enderror
                                    name="email" value="{{ $user->email }}" disabled autocomplete="email">
                                @error('email')
                                    <span class="mt-1 text-sm text-red-400" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="dob"
                                    class="mb-2 block font-bold text-gray-700">{{ __('Date of birth') }}</label>
                                <input type="date" id="dob"
                                    class="w-full rounded-2xl border px-3 py-2 focus:border-green-500 focus:outline-none"
                                    @error('dob') bg-red-700 @enderror name="dob" value="{{ $user->dob }}" required
                                    autocomplete="dob">
                                @error('dob')
                                    <span class="mt-1 text-sm text-red-400" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="w-1/2 pl-10 pr-14 pt-5">
                            <div class="mb-4">
                                <label for="name"
                                    class="mb-2 block font-bold text-gray-700">{{ __('Name') }}</label>
                                <input type="text" id="name"
                                    class="w-full rounded-2xl border px-3 py-2 focus:border-green-500 focus:outline-none"
                                    placeholder="{{ __('Enter your name') }}" @error('name') bg-red-700 @enderror
                                    name="name" value="{{ $user->name }}" required autocomplete="name">
                                @error('name')
                                    <span class="mt-1 text-sm text-red-400" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="phone_number"
                                    class="mb-2 block font-bold text-gray-700">{{ __('Phone') }}</label>
                                <input type="text" id="phone_number"
                                    class="w-full rounded-2xl border px-3 py-2 focus:border-green-500 focus:outline-none"
                                    placeholder="{{ __('Enter your phone number') }}"
                                    @error('phone_number') bg-red-700 @enderror name="phone_number"
                                    value="{{ $user->phone_number }}" required autocomplete="phone_number">
                                @error('phone_number')
                                    <span class="mt-1 text-sm text-red-400" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="px-14">
                        <label for="gender" class="mb-2 block font-bold text-gray-700">{{ __('Gender') }}</label>
                        <select id="gender" name="gender"
                            class="bord mt-1 block w-full rounded-2xl border-2 bg-white px-3 py-2 focus:border-green-500 focus:outline-none"
                            @error('gender') bg-red-700 @enderror name="gender" value="{{ $user->gender }}" required
                            autocomplete="gender">
                            <option value="male">{{ __('Male') }}</option>
                            <option value="female">{{ __('Female') }}</option>
                        </select>
                        @error('gender')
                            <span class="mt-1 text-sm text-red-400" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="justify-begin my-4 flex">
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
