@extends('layouts.master')
@section('body-class', '')

@section('styles')
    <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
    <style>
        .profile-section {
            max-width: 1000px;
            margin: 0 auto;
        }

        .profile-card {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .profile-card-header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .profile-card-header i {
            margin-right: 10px;
        }

        .profile-card-body {
            padding: 25px;
        }

        .profile-card-body p {
            margin-bottom: 15px;
            font-size: 16px;
        }

        .profile-card-body p strong {
            color: #333;
        }

        .business-card {
            margin-top: 30px;
            border: 1px solid #e3e3e3;
        }

        .alert a {
            text-decoration: underline;
            font-weight: bold;
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-header h1 {
            font-size: 30px;
            font-weight: bold;
            color: #333;
        }
    </style>
@endsection

@section('content')
<div class="page-container">
    @include('layouts.components.sidebar', ['page' => 'Dashboard'])

    <div class="page-content">
        @include('layouts.components.page-header', ['title' => 'Profile'])

        <div class="main-wrapper">

                {{-- User Details Section --}}
                <div class="card profile-card">
                    <div class="profile-card-header">
                        <i class="fas fa-user"></i> User Details
                    </div>
                    <div class="profile-card-body">
                        <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Role:</strong> {{ ucfirst(Auth::user()->role) }}</p>
                        <p><strong>Account Created:</strong> {{ Auth::user()->created_at ? Auth::user()->created_at->format('M d, Y') : 'N/A' }}</p>
                    </div>
                </div>

                {{-- Business Details Section --}}
                @if(Auth::user()->hasBusinessAccount())
                    <div class="card profile-card business-card">
                        <div class="profile-card-header bg-success text-white">
                            <i class="fas fa-briefcase"></i> Business Details
                        </div>
                        <div class="profile-card-body">
                            @foreach(Auth::user()->businesses as $business)
                                <p><strong>Business Name:</strong> {{ $business->business_name }}</p>
                                <p><strong>Business ID:</strong> {{ $business->business_id }}</p>
                                <p><strong>Email:</strong> {{ $business->business_email }}</p>
                                <p><strong>Phone:</strong> {{ $business->business_number }}</p>
                                <p><strong>Description:</strong> {{ $business->business_description }}</p>
                                @if(!$loop->last)
                                    <hr>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning mt-4">
                        You do not have a business account. <a href="{{ route('create.business.account') }}">Create one here</a>.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
