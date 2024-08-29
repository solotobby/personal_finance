@extends('layouts.master')
@section('body-class', '')
@section('styles')
        <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
@endsection


@section('content')
    <div class="page-container">
        @include('layouts.components.sidebar', ['page' => 'Transactions'])
        <div class="page-content">
            @include('layouts.components.page-header', ['title' => 'Report'])
            <div class="main-wrapper">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">

                                <div class="col-lg-12">
                                    <form method="GET" action="{{ url('transactions/report') }}">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Date</label>
                                            <select name="month" class="form-control" required>
                                                <option value="">Select One</option>
                                                <option value="08-2024">08-2024</option>
                                                <option value="09-2024">09-2024</option>
                                                <option value="10-2024">10-2024</option>
                                                <option value="11-2024">11-2024</option>
                                                <option value="12-2024">12-2024</option>
                                            </select>
                                            {{-- <input type="date" name="month" class="form-control" value="{{ $month ?? '' }}"> --}}
                                        </div>
                                        
                                        <br>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info">
                                                Fetch
                                            </button>
                                        </div>
                                    </form>
                                    <hr>
                                    <br>
                                    <center><strong>Report for {{ $date }}</strong></center>
                        
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">Credit(Income)</th>
                                                <th scope="col" class="text-center">DR(Expenses)</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $totalDr = 0;
                                            $totalCr = 0;
                                        @endphp
                                    <tbody>
                                            <tr>
                                               <!-- DR Column -->
                                            <td>
                                                @if($transactions)
                                                    @foreach($transactions as $transaction)
                                                        @if($transaction['category_id'] == 1) <!-- Debit -->
                                                            {{ $transaction['name'] }} - {{ html_entity_decode(config('app.currency.symbol')) }} {{ $transaction['amount'] }}<br>
                                                            @php $totalCr += (float) $transaction['amount']; @endphp
                                                      
                                                        @endif
                                                    @endforeach
                                                @else
                                                    No Data 
                                                @endif
                                            </td>

                                            <!-- CR Column -->
                                            <td>
                                                @if($transactions)
                                                    @foreach($transactions as $transaction)
                                                        @if($transaction['category_id'] == 2) <!-- Credit -->
                                                            {{ $transaction['name'] }} - {{ html_entity_decode(config('app.currency.symbol')) }} {{ $transaction['amount'] }}<br>
                                                            @php $totalDr += (float) $transaction['amount']; @endphp
                                                    
                                                        @endif
                                                    @endforeach
                                                @else
                                                    No Data 
                                                @endif
                                            </td>

                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><strong>Total CR:</strong> {{ html_entity_decode(config('app.currency.symbol')) }} {{ $totalCr }}</td>
                                                <td><strong>Total DR:</strong> {{ html_entity_decode(config('app.currency.symbol')) }} {{ $totalDr }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><strong>Profit:</strong> {{ html_entity_decode(config('app.currency.symbol')) }} {{ $totalCr - $totalDr }}</td>
                                            </tr>
                                        </tfoot>
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