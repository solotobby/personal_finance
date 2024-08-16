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

                            <div class="col-lg-12">
                            {{-- <form method="GET" action="{{ url('transactions') }}"> --}}
                                <div class="form-group">
                                    <a href="{{ url('fetch/staffs') }}" class="btn btn-primary">Fetch Staffs</a>
                                </div>
                            {{-- </form> --}}
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table">
                                <thead>
                                    <tr>
                                   
                                    <th scope="col">Staff ID</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Basic Amount</th>
                                    <th scope="col">When</th>
                                    {{-- <th scope="col">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php $i = 1; ?>
                                     @foreach($staffs as $cate)
                                     <tr>
                                        <td>
                                            {{$cate->staff_id}}
                                        </td>
                                        <td>
                                            {{$cate->role}}
                                        </td>
                                        <td>
                                            {{$cate->account_name}}
                                        </td>
                                        <td>
                                            NGN {{number_format($cate->basic_salary,2)}}
                                        </td>
                                        <td>
                                            {{$cate->created_at}}
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