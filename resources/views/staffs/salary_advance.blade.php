@extends('layouts.master')
@section('body-class', '')
@section('styles')
        <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="page-container">
    @include('layouts.components.sidebar', ['page' => 'Staff'])

    <div class="page-content">
        @include('layouts.components.page-header', ['title' => 'Salary Advance'])
        <div class="main-wrapper">

            <div class="row">
               
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="col-lg-3"></div> --}}
                            <div class="col-lg-12">
                                <div class="alert alert-info">
                                    Staffs can only take 30% of their salaries as Salary Advance which will be deducted in the following month salary!
                                </div>
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

                                    @if(session('error'))
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger">
                                                    <p>{{ session('error') }}</p>
                                                    <a class="close" href="#"></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                <form method="POST" action="{{ route('process.salary.advance') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="staff_id" class="col-form-label">Staff Name</label>
                                    {{-- <input id="email" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required > --}}
                                    <select class="form-control" name="staff_id" id="staff_id" required> 
                                        <option value="">Select a Staff</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->id }}">{{ $staff->account_name }}</option>
                                        @endforeach

                                    </select>
                                      
                                   
                                   
                                </div>
                                <div class="form-group">
                                    <label for="amount" class="col-form-label">Amount</label>
                                    <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required >
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mt-3">
                                   <button type="submit" class="btn btn-primary">
                                        Submit
                                   </button>
                                </div>

                            </form>
                            </div>
                            {{-- <div class="col-lg-3"></div> --}}
                        </div>
                    </div>
              
            </div>

        </div>
    </div>

</div>


@endsection

