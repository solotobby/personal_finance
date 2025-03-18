@extends('layouts.master')

@section('body-class', '')

@section('styles')
    <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-container">
        @include('layouts.components.staff-sidebar', ['page' => 'Staff Dashboard'])

        <div class="page-content">
            @include('layouts.components.staff-page-header', ['title' => 'Staff Dashboard'])

            <div class="main-wrapper">
               <!-- Password Reset Modal -->
@if ($isFirstLogin)
<div class="modal fade" id="passwordResetModal" tabindex="-1" aria-labelledby="passwordResetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordResetModalLabel">Reset Your Password</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>It looks like this is your first login. Please reset your password for security reasons.</p>
                <form action="{{ route('staff.reset-password') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="new_password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>

                    <!-- Logout Button with Corrected Syntax -->
                    <a href="#" class="btn btn-danger ms-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i data-feather="log-out"></i> {{ __('Logout') }}
                    </a>

                    <!-- Hidden Logout Form -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </form>
            </div>
        </div>
    </div>
</div>
@endif


                <div class="row">
                    <div class="col-lg-6">
                        <!-- Stats Cards -->
                        <div class="row">
                            <!-- Monthly Salary -->
                            <div class="col-lg-6">
                                <div class="card stats-card">
                                    <div class="card-body">
                                        <div class="stats-info">
                                            <h5 class="card-title">
                                                {{ html_entity_decode(config('app.currency.symbol')) }}
                                                {{ number_format($staff->salary ?? 0) }}
                                            </h5>
                                            <p class="stats-text">{{ __('Total Monthly Salary') }}</p>
                                        </div>
                                        {{-- <div class="stats-icon change-success">
                                            <i class="material-icons">payments</i>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                            <!-- Gross Salary -->
                            <div class="col-lg-6">
                                <div class="card stats-card">
                                    <div class="card-body">
                                        <div class="stats-info">
                                            <h5 class="card-title">
                                                {{ html_entity_decode(config('app.currency.symbol')) }}
                                                {{ number_format($total_paid ?? 0) }}
                                            </h5>
                                            <p class="stats-text">{{ __('Total Salary Received') }}</p>
                                        </div>
                                        {{-- <div class="stats-icon change-info">
                                            <i class="material-icons">payments</i>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Staff Profile Card -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body text-center">
                                {{-- <img src="{{ asset('assets/images/user-avatar.png') }}" alt="Profile Picture"
                                    class="rounded-circle mb-3" width="100"> --}}
                                <h5 class="card-title">{{ auth()->user()->name ?? 'N/A' }}</h5>
                                <p class="card-text">{{ auth()->user()->email ?? 'N/A' }}</p>
                                <p class="card-text"><strong>Staff ID:</strong> {{ auth()->user()->staff_id ?? 'N/A' }}</p>
                                <p class="card-text"><strong>Business Name:</strong>
                                    {{ auth()->user()->businessName ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Transactions Table -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-bg">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Payment Transactions') }}</h5>

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Month') }}</th>
                                            <th>{{ __('Payment Made By') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                            <th>{{ __('Date Paid') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Download') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($payslips as $index => $payslip)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ \Carbon\Carbon::parse($payslip->date)->format('F Y') }}</td>
                                                <td>{{ $payslip->payer_name }}</td>
                                                <td>NGN {{ number_format($payslip->amount, 2) }}</td>
                                                <td>{{ \Carbon\Carbon::parse($payslip->created_at)->format('d M Y, h:i A') }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $payslip->status == 'Paid' ? 'success' : ($payslip->status == 'Pending' ? 'warning' : 'danger') }}">
                                                        {{ ucfirst($payslip->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ url('download/payslip/' . $payslip->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        Download PDF
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No payment records found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Links -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card actions-widget text-center">
                            <div class="card-body">
                                <div class="actions-widget-item">
                                    {{-- Uncomment if needed --}}
                                    {{-- <button onclick="location.href='{{ route('staff.tasks') }}'" type="button"
                                        class="btn btn-circle text-info"><i class="fas fa-tasks"></i></button>
                                    <span class="actions-widget-item-title">{{ __('Staff Tasks') }}</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div> <!-- End main-wrapper -->
        </div> <!-- End page-content -->
    </div> <!-- End page-container -->


    @section('scripts')
    <script>
        $(document).ready(function() {
            $("#passwordResetModal").modal("show"); // Auto-show the modal if first login
        });
    </script>
        <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    @endsection

    @include('layouts.components.footer')
    @include('layouts.components.sidebar-overlay')

@endsection
