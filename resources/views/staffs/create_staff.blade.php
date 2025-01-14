@extends('layouts.master')
@section('body-class', '')
@section('styles')
    <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
    <style>
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 40vh;
        }

        .card {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 40px;
        }

        .form-title {
            font-weight: bold;
            color: #333;
        }

        .btn-primary {
            background-color: #b9d8fa;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .category-title {
            font-weight: bold;
            margin-bottom: 15px;
            color: #faf8f8;
        }

        .form-divider {
            margin-top: 30px;
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
        }

        .form-group {
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="page-container">
        @include('layouts.components.sidebar', ['page' => 'Add Staff'])
        <div class="page-content">
            @include('layouts.components.page-header', ['title' => 'Add Staff'])
            <div class="main-wrapper form-container">
                <div class="col-md-8 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title form-title text-center mb-4">Add Staff</h5>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    <p>{{ session('success') }}</p>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ url('add/staff') }}">
                                @csrf

                                <!-- Pass business_id as a hidden field -->
                                <input type="hidden" name="business_id" value="{{ auth()->user()->business_id }}">

                                <!-- Personal Information -->
                                <div class="category-title">Personal Information</div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" class="form-control" name="name"
                                        value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="sex">Sex</label>
                                    <select id="sex" class="form-control" name="sex" required>
                                        <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input id="date_of_birth" type="date" class="form-control" name="date_of_birth"
                                        value="{{ old('date_of_birth') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input id="phone" type="text" class="form-control" name="phone"
                                        value="{{ old('phone') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input id="address" type="text" class="form-control" name="address"
                                        value="{{ old('address') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="qualification">Qualification</label>
                                    <select name="qualification" class="form-control" required>
                                        <option value="">Select Qualification</option>
                                        @foreach ($qualifications as $qualification)
                                            <option value="{{ $qualification->name }}">{{ $qualification->name }}</option>
                                            value="{{ old('qualification') }}" required>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-divider"></div>

                                <!-- Finance Information -->
                                <div class="category-title">Finance Information</div>
                                <div class="form-group">
                                    <label for="account_number">Account Number</label>
                                    <input id="account_number" type="text" class="form-control" name="account_number"
                                        value="{{ old('account_number') }}">
                                </div>
                                <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                    <input id="account_name" type="text" class="form-control" name="account_name"
                                        value="{{ old('account_name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="bank_name">Bank Name</label>
                                    <input id="bank_name" type="text" class="form-control" name="bank_name"
                                        value="{{ old('bank_name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="basic_salary">Basic Salary</label>
                                    <input id="basic_salary" type="number" class="form-control" name="basic_salary"
                                        value="{{ old('basic_salary') }}">
                                </div>
                                <div class="form-group">
                                    <label for="bonus">Bonus</label>
                                    <input id="bonus" type="number" class="form-control" name="bonus"
                                        value="{{ old('bonus') }}">
                                </div>
                                <div class="form-divider"></div>

                                <!-- Organization Information -->
                                <div class="category-title">Organization Information</div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" class="form-control" required>
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            value="{{ old('role') }}" required>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="employment_date">Employment Date</label>
                                    <input id="employment_date" type="date" class="form-control"
                                        name="employment_date" value="{{ old('employment_date') }}" required>
                                </div>

                                <div class="form-group">
                                     <label for="department">Department</label>
                                    <select name="department" class="form-control" required>
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->name }}">{{ $department->name }}</option>
                                            value="{{ old('department') }}" required>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group text-center mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
@endsection
