@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Transaction - <b>&#8358; {{number_format($transactions->sum('amount'))}}</b>
                        | Income - <b>&#8358; {{number_format($transactions->where('category', 'Income')->sum('amount'))}}</b>
                        | Expenses - <b>&#8358; {{number_format($transactions->where('category', 'Expenses')->sum('amount'))}}</b>
                        | Savings - <b>&#8358; {{number_format($transactions->where('category', 'Savings')->sum('amount'))}}</b>

                    </div>
                    <br>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            {{--                                <th scope="col">#</th>--}}
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
                                    {{--                                    <th scope="row">{{$i++}}</th>--}}
                                    <td>
                                        @if($cate->transaction_date == "")
                                            {{\Carbon\Carbon::parse($cate->created_at)->format('d, M Y @ h:i  a')}}
                                        @else
                                            {{\Carbon\Carbon::parse($cate->transaction_date)->format('d, M Y @ h:i  a')}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$cate->name}}
                                        <span>
                                            @if($cate->from_budget)
                                                *
                                            @else

                                            @endif
                                        </span>

                                    </td>
                                    <td>&#8358; {{number_format($cate->amount)}}</td>
                                    <td>{{$cate->category}}</td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
