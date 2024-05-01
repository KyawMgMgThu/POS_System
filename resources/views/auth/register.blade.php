@extends('layouts.auth')





@section('content')
    <div class="d-flex align-items-center auth-content">
        <div class="col-lg-7 align-self-center">
            <div class="p-3">
                <h2 class="mb-2">{{ __('Register') }}</h2>
                <p>Create your @yield('title', config('app.name')) account.</p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="floating-label form-group">
                                <input id="name" type="text"
                                    class="floating-input form-control @error('name') is-invalid @enderror" name="name"
                                    value="">
                                <label>{{ __('Name') }}</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="floating-label form-group">
                                <input id="email" type="email"
                                    class="floating-input form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}">
                                <label for="email">{{ __('Email') }}</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="floating-label form-group">
                                <input id="password" type="password"
                                    class="floating-input form-control @error('password') is-invalid @enderror"
                                    name="password">
                                <label for="password">{{ __('Password') }}</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="floating-label form-group">

                                <input id="password-confirm" type="password" class="floating-input form-control"
                                    name="password_confirmation">
                                <label name="password-confirm">{{ __('Confirm Password') }}</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label"
                                    for="customCheck1">{{ __('I agree with the terms of use') }}</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                    <p class="mt-3">
                        {{ __('Already have an Account') }} <a href="{{ route('login') }}"
                            class="text-primary">{{ __('Login') }}</a>
                    </p>
                </form>
            </div>
        </div>
        <div class="col-lg-5 content-right">
            <img src="../assets/images/login/01.png" class="img-fluid image-right" alt="">
        </div>
    </div>
@endsection
