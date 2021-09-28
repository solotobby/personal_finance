@extends('layouts.master')
@section('body-class', 'login-page')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12 col-lg-4">
                <div class="card login-box-container">
                    <div class="card-body">
                        <div class="authent-logo">
                            <a href="{{  url('/') }}">{{ config('app.name', 'Personal Finance') }}</a>
                        </div>
                        <div class="authent-text">
                            {{-- <p>Welcome to Neo</p> --}}
                            <p>Please Create your Account</p>
                        </div>

                         <form method="POST" action="{{ route('register') }}">
                            @csrf
                            {{-- <div class="mb-3">
                                <div class="form-floating">
                                    <input id="floatingInput" type="text" placeholder="Fullname" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <label for="floatingInput">{{ __('Fullname') }}</label>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input id="floatingInput1" placeholder="name@example.com" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    <label for="floatingInput">{{ __('Email address') }}</label>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input id="floatingPassword" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <label for="floatingPassword">{{ __('Password') }}</label>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input id="floatingPassword1" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                                    <label for="floatingPassword1">{{ __('Confirm Password') }}</label>
                                </div>
                            </div> --}}
                            {{-- <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">I agree the <a href="#">Terms and Conditions</a></label>
                            </div> --}}
                            <div class="d-grid">

                            {{-- <button type="submit" class="btn btn-primary m-b-xs">{{ __('Register') }}</button> --}}
                            <a class="btn btn-success" href="{{ url('auth/google') }}">Register With 
                            <img src="https://img.icons8.com/color/20/000000/google-logo.png"/>
                            </a>
                        </div>
                            </form>
                            <div class="authent-login">
                                <p>Already have an account? <a href="{{ route('login') }}">{{ __('Sign in') }}</a></p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection