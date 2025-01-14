@extends('layouts.master')

@section('body-class', '')
@section('styles')
    <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="page-container">
    @include('layouts.components.sidebar', ['page' => 'Staff'])

    <div class="page-content">
        @include('layouts.components.page-header', ['title' => 'Staff Information'])

        <div class="main-wrapper">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">

                            <!-- Staff Details -->
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Name:</h5>
                                            <p>{{ $staff->name }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Staff ID:</h5>
                                            <p>{{ $staff->staff_id }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Email:</h5>
                                            <p>{{ $staff->email }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Phone:</h5>
                                            <p>{{ $staff->phone }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Sex:</h5>
                                            <p>{{ strtoupper($staff->sex) }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Date of Birth:</h5>
                                            <p>{{ \Carbon\Carbon::parse($staff->date_of_birth)->format('d M Y') }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Role:</h5>
                                            <p>{{ $staff->role }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Total Salary:</h5>
                                            <p>NGN {{ number_format($staff->salary, 2) }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Bonus:</h5>
                                            <p>{{ number_format($staff->bonus, 2) }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Basic Salary:</h5>
                                            <p>NGN {{ number_format($staff->basic_salary, 2) }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Department:</h5>
                                            <p>{{ $staff->department }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Bank Account:</h5>
                                            <p>{{ $staff->account_name }} ({{ $staff->account_number }}) ({{ $staff->bank_name }})</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Address:</h5>
                                            <p>{{ $staff->address }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Employment Date:</h5>
                                            <p>{{ \Carbon\Carbon::parse($staff->employment_date)->format('d M Y') }}</p>
                                        </div>
                                    </div>

                                    <hr>
                                    <!-- Generate Payslip Button -->
                                    <a href="{{ url('generate/payslip/'.$staff->staff_id) }}" class="btn btn-success">Generate Payslip</a>

                                    <a href="{{ url('staffs') }}" class="btn btn-primary">Back to Staff List</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
