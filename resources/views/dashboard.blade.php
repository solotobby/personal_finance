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
                <div class="row">
                  <div class="col-lg-6">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="card stats-card">
                          <div class="card-body">
                            <div class="stats-info">
                              <h5 class="card-title">{{ html_entity_decode(config('app.currency.symbol')) }} {{ $income - $expenses - $savings }}</h5>
                              <p class="stats-text">{{ __('Balance') }}</p>
                            </div>
                            <div class="stats-icon change-success">
                              <i class="material-icons">account_balance</i>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="card stats-card">
                          <div class="card-body">
                            <div class="stats-info">
                              <h5 class="card-title">{{ html_entity_decode(config('app.currency.symbol')) }} {{ $income }}</h5>
                              <p class="stats-text">{{ __('Income') }}</p>
                            </div>
                            <div class="stats-icon change-success">
                              <i class="material-icons">trending_up</i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="card stats-card">
                          <div class="card-body">
                            <div class="stats-info">
                                <h5 class="card-title">{{ html_entity_decode(config('app.currency.symbol')) }} {{ $expenses }}</h5>
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
                                <h5 class="card-title">{{ html_entity_decode(config('app.currency.symbol')) }} {{ $savings }}</h5>
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
                                        <th scope="col">{{ __('Category') }}</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php $i = 1; ?>
                                      @foreach($transactions as $t)
                                      <tr class="{{ $t->category == "Income" ? "text-success" : ($t->category == "Expenses" ? "text-danger" : ($t->category == "Savings" ? "text-info" : ""))  }}">
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{\Carbon\Carbon::parse($t->date)->format('d, M Y @ h:i  a')}}</td>
                                        <td>{{$t->name}}<span>{{ $t->from_budget ? "*" : ""}}</span></td>
                                        <td>{{ html_entity_decode(config('app.currency.symbol')) }} {{ number_format($t->amount) }}</td>
                                        <td>{{$t->category->name}}</td>
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
                    </div>
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
              @include('layouts.components.footer')
            </div>
        </div>
        @include('layouts.components.sidebar-overlay')
      @endsection

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
    @endsection