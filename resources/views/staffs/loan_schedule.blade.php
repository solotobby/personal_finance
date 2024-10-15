@extends('layouts.master')
@section('body-class', '')
@section('styles')
        <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
@endsection


@section('content')

<div class="page-container">
    @include('layouts.components.sidebar', ['page' => 'Staff'])

    <div class="page-content">
        @include('layouts.components.page-header', ['title' => 'Loan Schedule'])
        <div class="main-wrapper">

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">

                            <div class="col-12">
                                @if(session('success'))
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-success">
                                                <p>{{ session('success') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row mb-4">
                                    <div class="col-md-4">Staff Name:</div>
                                    <div class="col-md-8"> {{ $loanSchedule->staff->account_name }}</div>
                                    <div class="col-md-4"> Amount: NGN</div>
                                    <div class="col-md-8"> {{ number_format($loanSchedule->amount,2) }}</div>
                                    <div class="col-md-4"> Duration:</div>
                                    <div class="col-md-8">  {{ $loanSchedule->duration }} months</div>
                                    <div class="col-md-4"> Progress:</div>
                                    <div class="col-md-8">  
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{$percentage}}%" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100">{{$percentage}}%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Month</th>
                                        <th scope="col">Payment Date</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Payment Status</th>
                                        {{-- <th scope="col"></th> --}}
                                       
                                    {{-- <th scope="col">Action</th> --}}
                                    </tr>
                                </thead>
                                {{-- @if(!empty($loanSchedule->loan_schedule) && $loanSchedule->loan_schedule->count()) --}}
                                {{-- @if(!is_array($adviser['specs'])) --}}
                                <tbody>
                                     <?php $i = 1; ?>
                                     @foreach($loanSchedule->loanSchedule as $schedule)
                                     <tr>
                                       
                                        <td>
                                            {{$schedule->month}}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($schedule->payment_due_date)->format('d M Y') }}
                                        </td>
                                       
                                        <td>
                                            NGN {{number_format($schedule->amount_due,2)}}
                                        </td>
                                       
                                        {{-- <td>
                                           {{$schedule->is_paid == false ? 'Not Paid' : "Paid"}}
                                        </td> --}}
                                        <td>
                                            @if($schedule->is_paid == false)
                                                <a href="{{ url('change/status/'.$schedule->id) }}" class="btn btn-primary btn-sm"> {{$schedule->is_paid == false ? 'Not Paid' : "Paid"}} </a>
                                            @else
                                                {{$schedule->is_paid == false ? 'Not Paid' : "Paid"}}
                                            @endif
                                         </td>
                                        
                                     </tr>

                                     @endforeach
                                    </tbody>
                                    {{-- @else
                                        <p>No loan schedule available.</p>
                                    @endif --}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection