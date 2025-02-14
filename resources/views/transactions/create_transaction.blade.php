@extends('layouts.master')

@section('body-class', '')

@section('styles')
    <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-container">
        @include('layouts.components.sidebar', ['page' => 'Transaction'])

        <div class="page-content">
            @include('layouts.components.page-header', ['title' => 'Add Transaction'])

            <div class="main-wrapper">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Create Transaction</h5>

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        <p>{{ session('success') }}</p>
                                    </div>
                                @endif

                                <form method="POST" action="{{ url('transactions') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="text" name="amount" placeholder="Amount"
                                                class="form-control" id="amount" required>
                                            <label for="amount">{{ __('Amount') }}</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="text" name="name" class="form-control"
                                                id="transaction-name" required>
                                            <label for="transaction-name">{{ __('Name') }}</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <select name="category_id" id="category_id" class="form-control" required>
                                                <option value="">Select One</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="category_id">{{ __('Transaction Category') }}</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <select name="type_id" id="type_id" class="form-control" required>
                                                <option value="">Select One</option>
                                            </select>
                                            <label for="type_id">{{ __('Transaction Type') }}</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="datetime-local" name="date"
                                                class="form-control" id="date" required>
                                            <label for="date">{{ __('Pick Date') }}</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <textarea class="form-control" name="description" id="description" required></textarea>
                                            <label for="description">{{ __('Description') }}</label>
                                        </div>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-info m-b-xs">{{ __('Save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- /.col -->
                </div> <!-- /.row -->
            </div> <!-- /.main-wrapper -->
        </div> <!-- /.page-content -->
    </div> <!-- /.page-container -->
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Load transaction types dynamically based on category selection
        $('#category_id').change(function() {
            var categoryId = $(this).val();

            if (categoryId) {
                $.ajax({
                    url: '/get-types/' + categoryId, // Ensure this route is correct
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#type_id').empty();
                        $('#type_id').append('<option value="">Select One</option>');

                        $.each(data, function(key, value) {
                            $('#type_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function() {
                        alert('Error fetching types.');
                    }
                });
            } else {
                $('#type_id').empty();
                $('#type_id').append('<option value="">Select One</option>');
            }
        });
    });
</script>
@endsection
