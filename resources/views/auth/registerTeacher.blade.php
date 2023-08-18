<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>{{ __('Registration') }}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    </head>
    <body class="bg-gradient-to-r from-green-300 via-blue-400 to-blue-300">

        <header class="header bg-white shadow">
            <nav class="nav max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
                <a href="/" class="nav_logo text-black font-semibold text-xl">{{ env('APP_NAME') }}</a>
            </nav>
        </header>

        <form method="POST" action="{{ route('teacher.store') }}">
            @csrf
            <div class="flex flex-col h-auto px-96 pt-16">
                <h2 class="text-3xl bg-white font-bold rounded-t-3xl py-4 text-center">{{ __('Sign up') }}</h2>
                <div class="flex rounded-3xl">
                    <div class="w-1/2 bg-white pl-14 pr-10 pt-5 ">
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-bold mb-2">{{ __('Email') }}</label>
                            <input type="email" id="email" class="focus:border-green-500 focus:outline-none w-full border rounded-2xl px-3 py-2" placeholder="{{ __('Enter your email') }}" @error('email') bg-red-700 @enderror name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="mt-1 text-sm text-red-400" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 font-bold mb-2">{{ __('Password') }}</label>
                            <input type="password" id="password" class="focus:border-green-500 focus:outline-none w-full border rounded-2xl px-3 py-2" placeholder="{{ __('Enter your password') }}" @error('password') bg-red-700 @enderror name="password" required autocomplete="new-password">
                            @error('password')
                            <span class=" mt-1 text-sm text-red-400" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="block text-gray-700 font-bold mb-2">{{ __('Confirm Password') }}</label>
                            <input type="password" id="password-confirm" class="focus:border-green-500 focus:outline-none w-full border rounded-2xl px-3 py-2" placeholder="{{ __('Enter confirm password') }}" name="password_confirmation" required autocomplete="new-password">
                            @error('password-confirm')
                            <span class=" mt-1 text-sm text-red-400" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="w-1/2 bg-white pr-14 pl-10 pt-5">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">{{ __('Name') }}</label>
                            <input type="text" id="name" class="focus:border-green-500 focus:outline-none w-full border rounded-2xl px-3 py-2" placeholder="{{ __('Enter your name') }}" @error('name') bg-red-700 @enderror name="name" value="{{ old('name') }}" required autocomplete="name">
                            @error('name')
                            <span class="mt-1 text-sm text-red-400" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="phone_number" class="block text-gray-700 font-bold mb-2">{{ __('Phone') }}</label>
                            <input type="text" id="phone_number" class="focus:border-green-500 focus:outline-none w-full border rounded-2xl px-3 py-2" placeholder="{{ __('Enter your phone number') }}" @error('phone_number') bg-red-700 @enderror name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">
                            @error('phone_number')
                            <span class="mt-1 text-sm text-red-400" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="dob" class="block text-gray-700 font-bold mb-2">{{ __('Date of birth') }}</label>
                            <input type="date" id="dob" class="focus:border-green-500 focus:outline-none w-full border rounded-2xl px-3 py-2" @error('dob') bg-red-700 @enderror name="dob" value="{{ old('dob') }}" required autocomplete="dob">
                            @error('dob')
                            <span class=" mt-1 text-sm text-red-400" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-2 bg-white rounded-b-3xl pb-10 px-14">
                    <label for="gender" class="block text-gray-700 font-bold mb-2">{{ __('Gender') }}</label>
                    <select id="gender" name="gender" class="focus:border-green-500 focus:outline-none block border-2 w-full mt-1 py-2 px-3 rounded-2xl bg-white bord" @error('gender') bg-red-700 @enderror name="gender" value="{{ old('gender') }}" required autocomplete="gender">
                        <option value="male">{{ __('Male') }}</option>
                        <option value="female">{{ __('Female') }}</option>
                    </select>
                    @error('gender')
                    <span class="mt-1 text-sm text-red-400" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <button style="margin-left: 33.33%" class="w-1/3 text-center mt-10 py-3 px-4 bg-gradient-to-r from-green-400 to-blue-400 hover:from-green-300 hover:to-blue-300 text-white font-bold rounded-3xl">{{__('Register')}}</button>
                    <div class="text-center mt-3">
                        <span class="text-md-center">{{ __('Already have an account?') }}</span>
                        <a class="text-blue-500" href="/login">{{ __('Login') }}</a>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>
