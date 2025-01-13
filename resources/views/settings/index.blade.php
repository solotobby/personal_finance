@extends('layouts.master')

@section('body-class', '')

@section('styles')
    <style>
        .settings-section {
            max-width: 1000px;
            margin: 0 auto;
        }

        .settings-card {
            margin-bottom: 30px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
        }

        .empty-state {
            text-align: center;
            color: #aaa;
            font-style: italic;
        }
    </style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="settings-section">
        {{-- Categories Section --}}
        <div class="card settings-card">
            <div class="card-header">
                <h5>Categories</h5>
                <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">Add Category</button>
            </div>
            <div class="card-body">
                @if($categories->isEmpty())
                    <p class="empty-state">No categories found.</p>
                @else
                    <ul class="list-group">
                        @foreach($categories as $category)
                            <li class="list-group-item">
                                {{ $category->name }}
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        {{-- Roles Section --}}
        <div class="card settings-card">
            <div class="card-header">
                <h5>Roles</h5>
                <button class="btn btn-primary" data-toggle="modal" data-target="#roleModal">Add Role</button>
            </div>
            <div class="card-body">
                @if($roles->isEmpty())
                    <p class="empty-state">No roles found.</p>
                @else
                    <ul class="list-group">
                        @foreach($roles as $role)
                            <li class="list-group-item">
                                {{ $role->name }}
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        {{-- Departments Section --}}
        <div class="card settings-card">
            <div class="card-header">
                <h5>Departments</h5>
                <button class="btn btn-primary" data-toggle="modal" data-target="#departmentModal">Add Department</button>
            </div>
            <div class="card-body">
                @if($departments->isEmpty())
                    <p class="empty-state">No departments found.</p>
                @else
                    <ul class="list-group">
                        @foreach($departments as $department)
                            <li class="list-group-item">
                                {{ $department->name }}
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modals --}}
@include('settings.modals')
@endsection
