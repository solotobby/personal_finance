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
                            <p>Please Create your Account</p>
                        </div>

                        @if($errors->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->first('error') }}
                        </div>
                    @endif


                        <form id="registrationForm" method="POST" action="{{ url('register/user') }}">
                            @csrf

                            <!-- User Account Section -->
                            <div id="userAccountSection">
                                <div class="mb-3">
                                    <input id="name" type="text" class="form-control" placeholder="Fullname"
                                        name="name" required>
                                </div>
                                <div class="mb-3">
                                    <input id="email" type="email" class="form-control" placeholder="Email"
                                        name="email" required>
                                </div>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control" placeholder="Password"
                                            name="password" required>
                                        <button type="button" id="togglePassword" class="btn btn-outline-secondary"><i
                                                class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input id="password_confirmation" type="password" class="form-control"
                                            placeholder="Confirm Password" name="password_confirmation" required>
                                        <button type="button" id="toggleConfirmPassword"
                                            class="btn btn-outline-secondary"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                                <button type="button" id="continueBtn" class="btn btn-primary w-100">Continue</button>
                            </div>

                            <!-- Business Account Section (Hidden initially) -->
                            <div id="businessAccountSection" style="display: none;">
                                <div class="mb-3">
                                    <input id="business_name" type="text" class="form-control"
                                        placeholder="Business Name" name="business_name" required>
                                </div>
                                <div class="mb-3">
                                    <input id="business_email" type="email" class="form-control"
                                        placeholder="Business Email" name="business_email" required>
                                </div>
                                <div class="mb-3">
                                    <input id="business_phone" type="text" class="form-control"
                                        placeholder="Business Phone" name="business_phone" required>
                                </div>
                                <div class="mb-3">
                                    <input id="business_description" type="text" class="form-control"
                                        placeholder="Business Description" name="business_description" required>
                                </div>
                                <button type="submit" id="submitBtn" class="btn btn-success w-100">Register</button>
                            </div>

                            <div class="authent-login mt-3">
                                <p>Already have an account? <a href="{{ route('login') }}">{{ __('Sign in') }}</a></p>
                            </div>
                        </form>

                        <!-- Google Registration -->
                        <div class="mt-3">
                            <a class="btn btn-success w-100" href="{{ url('auth/google') }}">Register With
                                <img src="https://img.icons8.com/color/20/000000/google-logo.png" />
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Personal Finance') }}. All rights reserved.</p>
        </div>
    </footer>
@endsection

@section('scripts')
    <script src="{{ asset('js/tabs.js') }}"></script>
@endsection
