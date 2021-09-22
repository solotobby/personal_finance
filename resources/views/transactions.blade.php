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
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Filter
                            </button>
                        </div>
                    </form>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
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

                    <div class="d-flex justify-content-center">
                        {!! $transactions->links() !!}
                    </div>
{{--                    <ul class="pagination">--}}
{{--                        {{$transactions->links()}}--}}
{{--                    </ul>--}}

                </div>
            </div>
        </div>
    </div>

@endsection
