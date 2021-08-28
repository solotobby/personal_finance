@extends('layouts.master')
@section('body-class', '')
@section('styles')
        <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-container">
        @include('layouts.components.sidebar', ['page' => 'Transactions'])
        <div class="page-content">
            @include('layouts.components.page-header', ['title' => 'Transactions'])
            <div class="main-wrapper">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="stats-info">
                                <h5 class="card-title">{{ __('Balance') }}</h5>
                                <p class="stats-text">{{ html_entity_decode(config('app.currency.symbol')) }} {{ $income - $expenses - $savings }}</p>
                                </div>
                                <div class="stats-icon change-success">
                                <i class="material-icons">account_balance</i>
                                </div>
                            </div>
                            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="stats-info">
                                <h5 class="card-title">{{ __('Income') }}</h5>
                                <p class="stats-text">{{ html_entity_decode(config('app.currency.symbol')) }} {{ $income }}</p>
                                </div>
                                <div class="stats-icon change-success">
                                <i class="material-icons">trending_up</i>
                                </div>
                            </div>
                            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="stats-info">
                                <h5 class="card-title">{{ __('Expenses') }}</h5>
                                <p class="stats-text">{{ html_entity_decode(config('app.currency.symbol')) }} {{ $expenses }}</p>
                                </div>
                                <div class="stats-icon change-danger">
                                <i class="material-icons">trending_down</i>
                                </div>
                            </div>
                            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="stats-info">
                                <h5 class="card-title">{{ __('Savings') }}</h5>
                                <p class="stats-text">{{ html_entity_decode(config('app.currency.symbol')) }} {{ $savings }}</p>
                                </div>
                                <div class="stats-icon change-success">
                                <i class="material-icons">backup</i>
                                </div>
                            </div>
                            </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-bg actions-widget text-center">
                            <div class="card-body">
                                <div class="actions-widget-item">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-circle text-info"><i class="fas fa-user-plus"></i></button>
                                <span class="actions-widget-item-title">{{ __('Add Transaction') }}</span>
                                </div>
                                <div class="actions-widget-item">
                                <button onclick="location.href='{{ route('transactions.index') }}'" type="button" class="btn btn-circle text-success"><i class="fas fa-calendar"></i></button>
                                <span class="actions-widget-item-title">{{ __('All Transactions') }}</span>
                                </div>
                                <div class="actions-widget-item">
                                <button onclick="location.href='{{ route('budget.index') }}'" type="button" class="btn btn-circle text-info"><i class="fas fa-user-plus"></i></button>
                                <span class="actions-widget-item-title">{{ __('Add Budget') }}</span>
                                </div>                                  
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-4">
                        <div class="card card-bg text-center">
                        <div class="card-body">
                            <div class="">
                                <h5 class="text-white">Claim your gift</h5>
                                <p class="m-t-xs">5% off for the first buy</p>
                                <a href="#" class="btn btn-success widget-info-action">Register Now</a>
                            </div>
                        </div>
                        </div>
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-bg">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Recent Transactions') }}</h5>
                                <table class="table crypto-table">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('Date') }}</th>
                                        <th scope="col">{{ __('Name') }}</th>
                                        <th scope="col">{{ __('Amount') }}</th>
                                        <th scope="col">{{ __('Type') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($transactions as $t)
                                        <tr class="{{ $t->category == "Income" ? "text-success" : ($t->category == "Expenses" ? "text-danger" : ($t->category == "Savings" ? "text-info" : ""))  }}">
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{\Carbon\Carbon::parse($t->transaction_date)->format('d, M Y @ h:i  a')}}</td>
                                        <td>{{$t->name}}<span>{{ $t->from_budget ? "*" : ""}}</span></td>
                                        <td>{{ html_entity_decode(config('app.currency.symbol')) }} {{ number_format($t->amount) }}</td>
                                        <td>{{$t->category}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
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
                                        <td><span class="badge bg-success"></span></td>
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
                    </div>
                </div>
            </div>
            @include('layouts.components.footer')
        </div>
    </div>
    @include('layouts.components.sidebar-overlay')
    @include('transactions.insert_transaction_modal')
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
@endsection