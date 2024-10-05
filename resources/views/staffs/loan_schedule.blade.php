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
                                Staff Name: {{ $loanSchedule->staff->account_name }} <br>
                                Amount: NGN {{ number_format($loanSchedule->amount,2) }} <br>
                                Duration: {{ $loanSchedule->duration }} months
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Month</th>
                                        <th scope="col">Payment Date</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Payment Status</th>
                                       
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
                                       
                                        <td>
                                           {{$schedule->is_paid == false ? 'Not Paid' : "Paid"}}
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