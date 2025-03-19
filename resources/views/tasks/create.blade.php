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
        @include('layouts.components.sidebar', ['page' => 'Add Task'])
        <div class="page-content">
            @include('layouts.components.page-header', ['title' => 'Add Task'])
            <div class="main-wrapper form-container">
                <div class="col-md-8 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title form-title text-center mb-4">Create Task</h5>

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

                            <form method="POST" action="{{ route('tasks.store') }}">
                                @csrf

                                <input type="hidden" name="business_id" value="{{ auth()->user()->business_id }}">

                                <div class="category-title">Task Information</div>

                                <div class="form-group">
                                    <label for="title">Task Title</label>
                                    <input id="title" type="text" class="form-control" name="title"
                                        value="{{ old('title') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="staff_id">Assign to Staff</label>
                                    <select name="staff_id" class="form-control" required>
                                        <option value="">Select Staff</option>
                                        @foreach($staffs as $staff)
                                            <option value="{{ $staff->id }}" {{ old('staff_id') == $staff->id ? 'selected' : '' }}>
                                                {{ $staff->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="priority">Priority</label>
                                    <select name="priority" class="form-control" required>
                                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                        <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="due_date">Due Date</label>
                                    <input id="due_date" type="date" class="form-control" name="due_date"
                                        value="{{ old('due_date') }}" required>
                                </div>

                                <div class="form-group text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    {{-- <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a> --}}
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
