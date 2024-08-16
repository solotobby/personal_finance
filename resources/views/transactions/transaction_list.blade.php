@extends('layouts.master')
@section('body-class', '')
@section('styles')
        <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-container">
        @include('layouts.components.sidebar', ['page' => 'Transactions'])
        <div class="page-content">
            @include('layouts.components.page-header', ['title' => 'Transaction List'])
            <div class="main-wrapper">
                {{-- <div class="row">
                    <div class="col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="stats-info">
                                <h5 class="card-title">{{ __('Total Transaction') }}</h5>
                                <p class="stats-text">{{ html_entity_decode(config('app.currency.symbol')) }} {{number_format($transactions->sum('amount'))}}</p>
                                </div>
                                <div class="stats-icon change-success">
                                <i class="material-icons">total_transaction</i>
                                </div>
                            </div>
                            </div>
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="stats-info">
                                <h5 class="card-title">{{ __('Transaction') }}</h5>
                                <p class="stats-text">{{ html_entity_decode(config('app.currency.symbol')) }} {{number_format($transactions->sum('amount'))}}</p>
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
                                <p class="stats-text">{{ html_entity_decode(config('app.currency.symbol')) }} 
                                    {{number_format($income)}}
                                </p>
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
                                <p class="stats-text">{{ html_entity_decode(config('app.currency.symbol')) }} {{number_format($expenses)}}</p>
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
                                <p class="stats-text">{{ html_entity_decode(config('app.currency.symbol')) }} {{number_format($savings)}}</p>
                                </div>
                                <div class="stats-icon change-success">
                                <i class="material-icons">backup</i>
                                </div>
                            </div>
                            </div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">

                                <div class="col-lg-12">
                                <form method="GET" action="{{ url('transactions') }}">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">From</label>
                                        <input type="date" name="from" class="form-control" value="{{ $from ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">To</label>
                                        <input type="date" name="to" class="form-control"  value="{{ $to ?? '' }}">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            Filter
                                        </button>
                                    </div>
                                </form>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php $i = 1; ?>
                                        @foreach($transactions as $cate)
                                            @if($cate->category == "Income")
                                                <tr class="text-success">
                                            @elseif($cate->category == "Expenses")
                                                <tr class="text-danger">
                                            @elseif($cate->category == "Savings")
                                                <tr class="text-info">
                                                    @endif
                                                    <th scope="row">{{ $i++ }}</th>
                                                    <td>
                                                        @if($cate->date == "")
                                                            {{\Carbon\Carbon::parse($cate->created_at)->format('d, M Y @ h:i  a')}}
                                                        @else
                                                            {{\Carbon\Carbon::parse($cate->date)->format('d, M Y @ h:i  a')}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{$cate->name}}
                                                        <span>
                                                            @if($cate->budget_id)
                                                                *
                                                            @else

                                                            @endif
                                                        </span>

                                                    </td>
                                                    <td>&#8358; {{number_format($cate->amount)}}</td>
                                                    <td>{{$cate->category->name}}</td>
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
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
@endsection