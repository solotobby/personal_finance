@extends('layouts.master')
@section('body-class', '')
@section('styles')
    <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-container">
        @include('layouts.components.sidebar', ['page' => 'Dashboard'])
        <div class="page-content">
            @include('layouts.components.page-header', ['title' => 'Dashboard'])
            <div class="main-wrapper">
                <!-- Dashboard Content -->
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Stats Cards -->
                        <div class="row">
                            <!-- Balance -->
                            <div class="col-lg-6">
                                <div class="card stats-card">
                                    <div class="card-body">
                                        <div class="stats-info">
                                            <h5 class="card-title">{{ html_entity_decode(config('app.currency.symbol')) }}
                                                {{ number_format($income - $expenses - $savings) }}</h5>
                                            <p class="stats-text">{{ __('Balance') }}</p>
                                        </div>
                                        <div class="stats-icon change-success">
                                            <i class="material-icons">account_balance</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Income -->
                            <div class="col-lg-6">
                                <div class="card stats-card">
                                    <div class="card-body">
                                        <div class="stats-info">
                                            <h5 class="card-title">{{ html_entity_decode(config('app.currency.symbol')) }}
                                                {{ number_format($income) }}</h5>
                                            <p class="stats-text">{{ __('Income') }}</p>
                                        </div>
                                        <div class="stats-icon change-success">
                                            <i class="material-icons">trending_up</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- More Cards -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card stats-card">
                                    <div class="card-body">
                                        <div class="stats-info">
                                            <h5 class="card-title">{{ html_entity_decode(config('app.currency.symbol')) }}
                                                {{ number_format($expenses) }}</h5>
                                            <p class="stats-text">{{ __('Expenses') }}</p>
                                        </div>
                                        <div class="stats-icon change-danger">
                                            <i class="material-icons">trending_down</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card stats-card">
                                    <div class="card-body">
                                        <div class="stats-info">
                                            <h5 class="card-title">{{ html_entity_decode(config('app.currency.symbol')) }}
                                                {{ number_format($savings) }}</h5>
                                            <p class="stats-text">{{ __('Savings') }}</p>
                                        </div>
                                        <div class="stats-icon change-success">
                                            <i class="material-icons">backup</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card main-chart-card">
                            <div class="card-body">
                                <div id="apex3"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-bg actions-widget text-center">
                            <div class="card-body">
                                <div class="actions-widget-item">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                        class="btn btn-circle text-info"><i class="fas fa-user-plus"></i></button>
                                    <span class="actions-widget-item-title">{{ __('Add Transaction') }}</span>
                                </div>
                                <div class="actions-widget-item">
                                    <button onclick="location.href='{{ route('transactions.index') }}'" type="button"
                                        class="btn btn-circle text-success"><i class="fas fa-calendar"></i></button>
                                    <span class="actions-widget-item-title">{{ __('All Transactions') }}</span>
                                </div>
                                <div class="actions-widget-item">
                                    <button onclick="location.href='{{ route('budget.index') }}'" type="button"
                                        class="btn btn-circle text-info"><i class="fas fa-user-plus"></i></button>
                                    <span class="actions-widget-item-title">{{ __('Add Budget') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-bg">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Recent Transactions') }}</h5>
                                <table class="table crypto-table table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{ __('Date') }}</th>
                                            <th scope="col">{{ __('Name') }}</th>
                                            <th scope="col">{{ __('Amount') }}</th>
                                            <th scope="col">{{ __('Category') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($transactions as $t)
                                            <tr
                                                class="{{ $t->category == 'Income' ? 'text-success' : ($t->category == 'Expenses' ? 'text-danger' : ($t->category == 'Savings' ? 'text-info' : '')) }}">
                                                <th scope="row">{{ $i++ }}</th>
                                                <td>{{ \Carbon\Carbon::parse($t->date)->format('d, M Y @ h:i  a') }}</td>
                                                <td>{{ $t->name }}<span>{{ $t->from_budget ? '*' : '' }}</span></td>
                                                <td>{{ html_entity_decode(config('app.currency.symbol')) }}
                                                    {{ number_format($t->amount) }}</td>
                                                <td>{{ $t->category->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-4">
                  <div class="card card-bg">
                      <div class="card-body">
                          <h5 class="card-title">{{ __('Budgets') }}</h5>
                          <table class="table">
                              <thead>
                                  <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Amount</th>
                                  </tr>
                                </thead>
                              <tbody>
                                <tr>
                                  <td>{{ __('Total') }}</td>
                                  <td><span class="badge bg-info"></span></td>
                                  <td>{{ html_entity_decode(config('app.currency.symbol')) }} {{ number_format($budgets->sum('amount')) }}</td>
                                </tr>
                                <tr>
                                  <td>{{ __('Completed') }}</td>
                                  <td>
                                    <span class="badge bg-success"></span>
                                  </td>
                                  <td>{{ html_entity_decode(config('app.currency.symbol')) }} {{ number_format($budgets->where('status', true)->sum('amount')) }}</td>
                                </tr>
                                <tr>
                                  <td>{{ __('Pending') }}</td>
                                  <td><span class="badge bg-success"></span></td>
                                  <td>{{ html_entity_decode(config('app.currency.symbol')) }} {{ number_format($budgets->sum('amount') - $budgets->where('status', true)->sum('amount')) }}</td>
                                </tr>
                              </tbody>
                            </table>
                      </div>
                  </div>
              </div> --}}
                </div>
                {{-- <div class="row">
            <div class="col-lg-4">
              <div class="card card-bg">
                <div class="card-body">
                  <h5 class="card-title">{{ __('Expenses') }}</h5>
                  <div id="sparkline1"></div>

              </div>
            </div>
            </div>
            <div class="col-lg-4">
              <div class="card card-bg">
                <div class="card-body">
                  <h5 class="card-title">{{ __('Savings') }}</h5>
                  <div id="sparkline2"></div>
              </div>
            </div>
            </div>
            <div class="col-lg-4">
              <div class="card card-bg">
                <div class="card-body">
                  <h5 class="card-title">{{ __('Income') }}</h5>
                  <div id="sparkline3"></div>
              </div>
            </div>
            </div>
          </div> --}}

            </div>
        </div>
    </div>
    </div>
    <!-- Modal for No Business Account -->
    @if (!Auth::user()->has_business_account)
        <div class="modal fade show" id="businessAccountModal" tabindex="-1" role="dialog"
            aria-labelledby="businessAccountModalLabel" aria-hidden="true" style="display: block;">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center w-100" id="businessAccountModalLabel">Create Business
                            Account</h5>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted mb-4 text-center" style="max-width: 600px; margin: 0 auto;">
                            Your account does not have a business account. Kindly fill the form below to complete
                            your registration.
                        </p>
                        <!-- Error Alert -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="businessForm" method="POST" action="{{ route('create.business.account') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input id="business_name" type="text" class="form-control"
                                        placeholder="Business Name" name="business_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input id="business_email" type="email" class="form-control"
                                        placeholder="Business Email" name="business_email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input id="business_phone" type="text" class="form-control"
                                        placeholder="Business Phone" name="business_phone" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input id="business_description" type="text" class="form-control"
                                        placeholder="Business Description" name="business_description" required>
                                </div>
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" id="submitBusiness" class="btn btn-primary btn-sm"
                                    style="background-color: #001f3f; border-color: #001f3f;">Register</button>
                            </div>
                        </form>

                        <!-- Logout Button -->
                        <div class="text-center mt-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" class="btn btn-danger">Logout</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mb-3"></div>
                </div>
            </div>
        </div>
    @endif

    @include('transactions.insert_transaction_modal')

@section('scripts')
    <script>
        var income_stat = @json($income_stat);
        var expenses_stat = @json($expenses_stat);
        var savings_stat = @json($savings_stat);
        var month_categories = @json($dates);
    </script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/pages/tabs.js') }}"></script>
@endsection

@include('layouts.components.footer')
@include('layouts.components.sidebar-overlay')
@endsection

