<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>{{ __('Login') }}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="bg-gradient-to-r from-green-300 via-blue-400 to-blue-300">
        <header class="header bg-white shadow">
            <nav class="nav max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
                <a href="/" class="nav_logo text-black font-semibold text-xl">{{ env('APP_NAME') }}</a>
            </nav>
        </header>

        <form method="POST" action="{{ route('login') }}" class=" mb-6 pt-10 px-10">
            @csrf
            <div class="form  max-w-lg mx-auto py-12 px-12 bg-white shadow-lg rounded-3xl">
                <h1 class="text-center text-3xl font-bold mb-10">{{ __('Login') }}</h1>
                <label for="email" class="login-label mb-4 block font-bold  text-gray-700">{{ __('Email') }}</label>
                <input id="email" type="email" class="focus:border-green-500 focus:outline-none block w-full rounded-2xl border py-3 mt-1 px-3" name="email" value="{{ old ('email') }}" required autocomplete="email" autofocus placeholder="Email">
                @error('email')
                    <span class="invalid-feedback block mt-2 text-sm text-red-600">{{ $message }}</span>
                @enderror

                <label for="password" class="mb-4 block mt-5 font-bold text-gray-700">{{ __('Password') }}</label>
                <input type="password" id="password" class="focus:border-green-500 focus:outline-none rounded-2xl border py-3 block w-full mt-1  px-3" placeholder="{{__('Password')}}" value="{{ old('password') }}" required autocomplete="{password}" 
                    @error('password') is-invalid @enderror name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback block mt-2 text-sm text-red-600">{{ $message }}</span>
                @enderror

                <div class="flex items-center mt-5">
                    <input class="focus:border-green-500 focus:outline-none form-check-input h-4 w-4 text-green-500" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label ml-2 text-sm text-gray-700" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <button type="submit" class="rounded-2xl text-xl  block w-full mt-8 mb-4 py-3 px-4 bg-gradient-to-r from-green-400 to-blue-400 hover:from-pink-500 hover:to-yellow-500 focus:ring-2 focus:ring-green-300 focus:ring-opacity-50 text-white font-medium">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link text-sm text-blue-500" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif

                <p class="login-already mt-5 text-center">
                    <span>{{ __("Don't have an account yet?") }}</span>
                    <a href="/register" class="login-login-link text-blue-500">{{ __('Register now') }}</a>
                </p>
            </div>
        </form>
    </body>
</html>
