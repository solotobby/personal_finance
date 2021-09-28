@extends('layouts.master')
@section('body-class', '')
@section('styles')
        <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-container">
        @include('layouts.components.sidebar', ['page' => 'Budget'])
        <div class="page-content">
            @include('layouts.components.page-header', ['title' => 'Budget'])
            <div class="main-wrapper">
                  <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Create Budget</h5>
                                    <p class="card-description"></p>
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

                                  <form method="POST" action="{{ url('budget') }}">
                                      @csrf
                                    
                                        <div class="form-group">
                                          <label for="email" class="col-form-label">Date</label>
                                          <input class="form-control @error('date') is-invalid @enderror" type="month" id="start" name="date" min="2021-01" value="{{ old('date') ?? date('Y-m') }}">
                                        <div id="emailHelp" class="form-text">Select Budget Month</div>
                                          @error('date')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>

                                      <div class="form-group">
                                        <label for="email" class="col-form-label">Budget Name</label>
                                        <input id="email" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required >
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group ">
                                        <label for="email" class="col-form-label">Budget Amount</label>
                                        <input id="email" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required>
                                        @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                            <label for="password" class="col-form-label">Budget Type</label>
                                            <select class="form-control" name="category_id" required>
                                                @foreach($categories as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Message:</label>
                                        <textarea name="description" id="message-text" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description') }}</textarea>
                                    </div>
                                    <br>
                                      <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                  </form>
                                </div>
                            </div>
                        </div>
                    </div>
          
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
@endsection