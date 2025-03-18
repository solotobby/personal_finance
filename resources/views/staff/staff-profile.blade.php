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
    </style>
@endsection

@section('content')
<div class="page-container">
    @include('layouts.components.staff-sidebar', ['page' => 'Dashboard'])

    <div class="page-content">
        @include('layouts.components.staff-page-header', ['title' => 'Staff Dashboard'])

        <div class="main-wrapper">

            {{-- Staff Details Section --}}
            <div class="card profile-card">
                <div class="profile-card-header">
                    <i class="fas fa-user"></i> Staff Details
                </div>
                <div class="profile-card-body">
                    <div class="row">
                        <div class="col-md-6"><p><strong>Name:</strong> {{ $staff->name }}</p></div>
                        <div class="col-md-6"><p><strong>Staff ID:</strong> {{ $staff->staff_id }}</p></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6"><p><strong>Email:</strong> {{ $staff->email }}</p></div>
                        <div class="col-md-6"><p><strong>Phone:</strong> {{ $staff->phone }}</p></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6"><p><strong>Business ID:</strong> {{ $business->business_id }} </p></div>
                        <div class="col-md-6"><p><strong>Business Name:</strong> {{ $business->business_name }}</p></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6"><p><strong>Department:</strong> {{ $staff->department }}</p></div>
                        <div class="col-md-6"><p><strong>Role:</strong> {{ ucfirst($staff->role) }}</p></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6"><p><strong>Basic Salary:</strong> NGN {{ number_format($staff->basic_salary, 2) }}</p></div>
                        <div class="col-md-6"><p><strong>Bonus:</strong> NGN {{ number_format($staff->bonus, 2) }}</p></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6"><p><strong>Total Salary:</strong> NGN {{ number_format($staff->salary, 2) }}</p></div>
                        <div class="col-md-6"><p><strong>Sex:</strong> {{ $staff->sex}}</p></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6"><p><strong>Bank Account:</strong> {{ $staff->account_name }} ({{ $staff->account_number }}) - {{ $staff->bank_name }}</p></div>
                        <div class="col-md-6"><p><strong>Employment Date:</strong> {{ \Carbon\Carbon::parse($staff->employment_date)->format('d M Y') }}</p></div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
