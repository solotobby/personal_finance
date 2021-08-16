@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Welcome {{Auth::user()->name}}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <p>{{ session('success') }}</p>
                                    <a class="close" href="#"></a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-3">
                            <h3>Av. Fund</h3>
                            &#8358;{{number_format($tran->where('category', 'Income')->sum('amount') - $tran->where('category', 'Expenses')->sum('amount') - $tran->where('category', 'Savings')->sum('amount'))}}
                        </div>
                        <div class="col-md-3">
                            <h3>Income</h3>
                            &#8358;{{number_format($tran->where('category', 'Income')->sum('amount'))}}
                        </div>
                        <div class="col-md-3">
                            <h3>Savings</h3>
                            &#8358;{{number_format($tran->where('category', 'Savings')->sum('amount'))}}
                        </div>
                        <div class="col-md-3">
                            <h3>Expenses</h3>
                            &#8358;{{number_format($tran->where('category', 'Expenses')->sum('amount'))}}
                        </div>
                    </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <h4>Total Budgets</h4>
                                &#8358; {{number_format($budgets->sum('amount'))}}
                            </div>
                            <div class="col-md-4">
                                <h4>Completed Budgets</h4>
                                &#8358; {{number_format($budgets->where('status', true)->sum('amount'))}}
                            </div>

                            <div class="col-md-4">
                                <h4>Uncompleted Budgets</h4>
                                &#8358; {{number_format($budgets->sum('amount') - $budgets->where('status', true)->sum('amount'))}}
                            </div>
                        </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                Add Transaction
                            </button>

                            <a href="{{ url('budget') }}" class="btn btn-primary">Create Budget</a>
                        </div>
                        <br><br>

                        <h3>Transactions List</h3>
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
    </div>
</div>



<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="POST" action="{{ url('transaction') }}">
                        @csrf

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Amount</label>
                            <input type="text" name="amount" class="form-control" id="recipient-name" required>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="recipient-name" required>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Type</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">Select One</option>
                                @foreach($categories as $cate)
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Pick Date</label>
                            <input type="datetime-local" name="transaction_date" class="form-control" id="recipient-name" required>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" name="description" id="message-text" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
{{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div>
    </div>
</div>

@endsection
