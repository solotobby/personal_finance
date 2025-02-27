@extends('layouts.master')
@section('body-class', '')
@section('styles')
    <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-container">
        @include('layouts.components.sidebar', ['page' => 'Staff'])

        <div class="page-content">
            @include('layouts.components.page-header', ['title' => 'Staff List'])
            <div class="main-wrapper">

                <!-- Business Stats Section -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5>Total Staff</h5>
                                <h2>{{ $total_staff }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-primary text-dark">
                            <div class="card-body">
                                <h5>Total Monthly Salary</h5>
                                <h2>NGN {{ number_format($total_paid, 2) }}</h2>
                            </div>
                        </div>
                    </div>

                    {{-- </div> --}}

                    <div class="col-md-5">
                        <div class="card bg-warning text-dark">
                            <div class="card-body">
                                <h5>Total Salary Paid Out</h5>
                                <h2>NGN {{ number_format($total_paid, 2) }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <a href="{{ url('fetch/staffs') }}" class="btn btn-warning text-black-50">Fetch Staffs</a>
                                        <a href="{{ url('create/staff') }}" class="btn btn-primary text-black-50">Add Staff</a>
                                    </div>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Staff ID</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Basic Amount</th>
                                                <th scope="col">When</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($staffs as $cate)
                                                <tr style="cursor: pointer;"
                                                    onclick="window.location='{{ url('staff/' . $cate->staff_id) }}'">
                                                    <td>{{ $cate->staff_id }}</td>
                                                    <td>{{ $cate->role }}</td>
                                                    <td>{{ $cate->name }}</td>
                                                    <td>NGN {{ number_format($cate->salary, 2) }}</td>
                                                    <td>{{ $cate->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    @endsection
