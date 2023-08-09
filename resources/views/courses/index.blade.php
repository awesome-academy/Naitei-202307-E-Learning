@extends('layouts.app')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@section('content')
    <div class="cards ml-10 mr-10 mt-10">
        <a class="card" href="">
            <img src="{{ asset('images/bg.jpg') }}" alt="" class="card-image" />
            <div class="card-content">
                <div class="card-top">
                    <h1 class="card-title">{{ __('Laravel') }}</h1>
                    <p class="card-content mb-5">
                        {{ __('Laravel is a web application framework with expressive, elegant syntax.') }}
                    </p>
                    <div class="card-user">
                        <img src="{{ asset('images/bg.jpg') }}" alt="" class="card-user-avatar" />
                        <div class="card-user-info">
                            <div class="card-user-top">
                                <h4 class="card-user-name">{{ __('Van Tanh') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-bottom">
                    <div class="card-watching">{{ __('35 Enrolled') }}</div>
                </div>
            </div>
        </a>

        <div class="card">
            <img src="{{ asset('images/bg.jpg') }}" alt="" class="card-image" />
            <div class="card-content">
                <div class="card-top">
                    <h3 class="card-title">{{ __('Laravel') }}</h3>
                    <p class="card-content mb-5">
                        {{ __('Laravel is a web application framework with expressive, elegant syntax.') }}
                    </p>
                    <div class="card-user">
                        <img src="{{ asset('images/bg.jpg') }}" alt="" class="card-user-avatar" />
                        <div class="card-user-info">
                            <div class="card-user-top">
                                <h4 class="card-user-name">{{ __('Van Tanh') }}</h4>
                                <ion-icon name="checkmark-circle"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-bottom">
                    <div class="card-watching">{{ __('35 Enrolled') }}</div>
                </div>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('images/bg.jpg') }}" alt="" class="card-image" />
            <div class="card-content">
                <div class="card-top">
                    <h3 class="card-title">{{ __('Laravel') }}</h3>
                    <p class="card-content mb-5">
                        {{ __('Laravel is a web application framework with expressive, elegant syntax.') }}
                    </p>
                    <div class="card-user">
                        <img src="{{ asset('images/bg.jpg') }}" alt="" class="card-user-avatar" />
                        <div class="card-user-info">
                            <div class="card-user-top">
                                <h4 class="card-user-name">{{ __('Van Tanh') }}</h4>
                                <ion-icon name="checkmark-circle"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-bottom">
                    <div class="card-watching">{{ __('35 Enrolled') }}</div>
                </div>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('images/bg.jpg') }}" alt="" class="card-image" />
            <div class="card-content">
                <div class="card-top">
                    <h3 class="card-title">{{ __('Laravel') }}</h3>
                    <p class="card-content mb-5">
                        {{ __('Laravel is a web application framework with expressive, elegant syntax.') }}
                    </p>
                    <div class="card-user">
                        <img src="{{ asset('images/bg.jpg') }}" alt="" class="card-user-avatar" />
                        <div class="card-user-info">
                            <div class="card-user-top">
                                <h4 class="card-user-name">{{ __('Van Tanh') }}</h4>
                                <ion-icon name="checkmark-circle"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-bottom">
                    <div class="card-watching">{{ __('35 Enrolled') }}</div>
                </div>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('images/bg.jpg') }}" alt="" class="card-image" />
            <div class="card-content">
                <div class="card-top">
                    <h3 class="card-title">{{ __('Laravel') }}</h3>
                    <p class="card-content mb-5">
                        {{ __('Laravel is a web application framework with expressive, elegant syntax.') }}
                    </p>
                    <div class="card-user">
                        <img src="{{ asset('images/bg.jpg') }}" alt="" class="card-user-avatar" />
                        <div class="card-user-info">
                            <div class="card-user-top">
                                <h4 class="card-user-name">{{ __('Van Tanh') }}</h4>
                                <ion-icon name="checkmark-circle"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-bottom">
                    <div class="card-watching">{{ __('35 Enrolled') }}</div>
                </div>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('images/bg.jpg') }}" alt="" class="card-image" />
            <div class="card-content">
                <div class="card-top">
                    <h3 class="card-title">{{ __('Laravel') }}</h3>
                    <p class="card-content mb-5">
                        {{ __('Laravel is a web application framework with expressive, elegant syntax.') }}
                    </p>
                    <div class="card-user">
                        <img src="{{ asset('images/bg.jpg') }}" alt="" class="card-user-avatar" />
                        <div class="card-user-info">
                            <div class="card-user-top">
                                <h4 class="card-user-name">{{ __('Van Tanh') }}</h4>
                                <ion-icon name="checkmark-circle"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-bottom">
                    <div class="card-watching">{{ __('35 Enrolled') }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
