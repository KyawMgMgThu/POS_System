@extends('layouts.auth')

@section('content')
    <div class="d-flex align-items-center auth-content">
        <div class="col-lg-7 align-self-center">
            <div class="p-3">
                <h2 class="mb-2">{{ __('Login') }}</h2>
                <p>{{ __('Login to stay connected.') }}</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
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
                        <div class="col-lg-12">
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
                            <div class="custom-control custom-checkbox mb-3">

                                <div class="form-check">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="custom-control-label control-label-1" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-primary float-right">{{ __('Forgot Your Password?') }}</a>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                    <p class="mt-3">
                        {{ __('Create an Account') }} <a href="{{ route('register') }}"
                            class="text-primary">{{ __('Sign Up') }}</a>
                    </p>

                </form>
            </div>
        </div>
        <div class="col-lg-5 content-right">
            <img src="../assets/images/login/01.png" class="img-fluid image-right" alt="">
        </div>
    </div>
@endsection
