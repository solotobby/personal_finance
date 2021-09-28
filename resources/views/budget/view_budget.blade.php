@extends('layouts.master')
@section('body-class', '')
@section('styles')
        <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-container">
        @include('layouts.components.sidebar', ['page' => 'Budget'])
        <div class="page-content">
            @include('layouts.components.page-header', ['title' => 'Budget Summary'])
            <div class="main-wrapper">

                <div class="row">
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
                            @foreach ($budgets as $budget)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{\Carbon\Carbon::parse($budget->date)->format('d, M Y @ h:i  a')}}</td>
                                    <td>{{ $budget->name }}</td>
                                    <td>{{ html_entity_decode(config('app.currency.symbol')) }} {{ number_format($budget->amount) }}</td>
                                    <td>{{ $budget->category->name }}</td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                        </table>
                    </div>
                                
                </div>

            </div>
        </div>
    </div>
@endsection

