@extends('layouts.master')
@section('body-class', '')
@section('styles')
        <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
@endsection


@section('content')

<div class="page-container">
    @include('layouts.components.sidebar', ['page' => 'Staff'])

    <div class="page-content">
        @include('layouts.components.page-header', ['title' => 'Staff List'])
        <div class="main-wrapper">

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">

                            
                            <div class="table-responsive">
                                <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Staff Name</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Monthly Repayment</th>
                                        <th scope="col">Stat Date</th>
                                        <th scope="col">End Date</th>
                                        <th scope="col">Status</th>
                                    {{-- <th scope="col">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php $i = 1; ?>
                                     @foreach($loans as $loan)
                                     <tr>
                                        <td>
                                            {{$loan->staff->account_name}}
                                        </td>
                                        <td>
                                            {{$loan->duration}} months
                                        </td>
                                        <td>
                                            NGN {{number_format($loan->amount,2)}}
                                        </td>
                                        <td>
                                            NGN {{number_format($loan->repayment_amount,2)}}
                                        </td>
                                        <td>
                                           {{$loan->start_date}}
                                        </td>
                                        <td>
                                            {{$loan->end_date}}
                                        </td>
                                        <td>
                                            {{$loan->status}}
                                        </td>
                                        {{-- <td></td> --}}
                                     </tr>

                                     @endforeach
                                    {{-- @foreach($transactions as $cate)
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
                                                     --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection