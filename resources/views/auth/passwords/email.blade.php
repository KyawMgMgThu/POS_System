@extends('layouts.auth')

@section('content')
    <div class="d-flex align-items-center auth-content">
        <div class="col-lg-7 align-self-center">
            <div class="p-3">
                <h2 class="mb-2">{{ __('Reset Password') }}</h2>
                <p>{{ __('Enter your email address ') }}</p>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="floating-label form-group">
                                <input id="email" type="email"
                                    class="floating-input form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <label>{{ __('Email') }}</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Reset</button>
                </form>
            </div>
        </div>
        <div class="col-lg-5 content-right">
            <img src="../assets/images/login/01.png" class="img-fluid image-right" alt="">
        </div>
    </div>
@endsection
