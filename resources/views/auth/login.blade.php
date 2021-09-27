@extends('layouts.master')
@section('body-class', 'login-page')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12 col-lg-4">
                <div class="card login-box-container">
                    <div class="card-body">
                        <div class="authent-logo">
                            <a href="{{ url('/') }}">{{ config('app.name', 'Personal Finance') }}</a>
                        </div>
                        <div class="authent-text">
                            {{-- <p>Welcome </p> --}}
                            <p>Please Sign-in to your account.</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input id="floatingInput" type="email" placeholder="name@example.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <label for="floatingInput">{{ __('E-Mail Address') }}</label>
                                    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input id="floatingPassword" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <label for="floatingPassword">{{ __('Password') }}</label>
                                    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                            </div>
                            <div class="d-grid">
                            <button type="submit" class="btn btn-info m-b-xs">Sign In</button>
                            <a class="btn btn-success" href="{{ url('auth/google') }}">SignIn With Google</a>
                        </div>
                            </form>
                                <div class="authent-reg">
                                <p>Not registered? <a href="{{ route('register') }}">Create an account</a></p>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection