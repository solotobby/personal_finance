@extends('layouts.master')

@section('content')
    <div class="page-container">
        <div class="page-content">
            @include('layouts.components.page-header', ['title' => 'Create Business Account'])

            <div class="main-wrapper">
                <form method="POST" action="{{ url('/create-business-account') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input id="business_name" type="text" class="form-control" placeholder="Business Name" name="business_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input id="business_email" type="email" class="form-control" placeholder="Business Email" name="business_email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input id="business_phone" type="text" class="form-control" placeholder="Business Phone" name="business_phone" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input id="business_description" type="text" class="form-control" placeholder="Business Description" name="business_description" required>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-sm" style="background-color: #001f3f; border-color: #001f3f;">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
