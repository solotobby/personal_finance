@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Categories</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('category') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

{{--                            <div class="form-group row">--}}
{{--                                <label for="password" class="col-md-4 col-form-label text-md-right">Type</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <select class="form-control" name="type" required>--}}
{{--                                        <option value="">Select One</option>--}}
{{--                                        <option> Income </option>--}}
{{--                                        <option> Debits </option>--}}
{{--                                        <option> Savings </option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
{{--                                <th scope="col">Type</th>--}}
{{--                                <th scope="col">Handle</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($categories as $cate)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <td>{{$cate->name}}</td>
{{--                                <td>{{$cate->type}}</td>--}}
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
