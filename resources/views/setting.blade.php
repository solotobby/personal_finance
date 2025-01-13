@extends('layouts.master')

@section('body-class', '')

@section('styles')
    <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
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

    <div class="page-container">
        @include('layouts.components.sidebar', ['page' => 'Settings'])

        <div class="page-content">
            @include('layouts.components.page-header', ['title' => 'Settings'])

            <div class="main-wrapper">
                <div class="settings-section">
                    {{-- Categories Section --}}
                    <div class="card settings-card">
                        <div class="card-header">
                            <h5>Categories</h5>
                            <button class="btn btn-primary" onclick="$('#categoryModal').modal('show');">Add Category</button>
                            {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">Add Category</button> --}}
                        </div>
                        <div class="card-body">
                            @if ($categories->isEmpty())
                                <p class="empty-state">No categories found.</p>
                            @else
                                <ul class="list-group">
                                    @foreach ($categories as $category)
                                        <li class="list-group-item">
                                            {{ $category->name }}
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                    {{-- Types Section --}}
                    <div class="card settings-card">
                        <div class="card-header">
                            <h5>Category Types</h5>
                            <button class="btn btn-primary" onclick="$('#typeModal').modal('show');">Add Type</button>
                        </div>
                        <div class="card-body">
                            @if ($types->isEmpty())
                                <p class="empty-state">No types found.</p>
                            @else
                                <ul class="list-group">
                                    @foreach ($types as $type)
                                        <li class="list-group-item">
                                            {{ $type->name }} (Category: {{ $type->category->name }})
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
                            <button class="btn btn-primary" onclick="$('#roleModal').modal('show');">Add Role</button>
                            {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#roleModal">Add Role</button> --}}
                        </div>
                        <div class="card-body">
                            @if ($roles->isEmpty())
                                <p class="empty-state">No roles found.</p>
                            @else
                                <ul class="list-group">
                                    @foreach ($roles as $role)
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
                            <button class="btn btn-primary" onclick="$('#departmentModal').modal('show');">Add
                                Department</button>
                            {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#departmentModal">Add Department</button> --}}
                        </div>
                        <div class="card-body">
                            @if ($departments->isEmpty())
                                <p class="empty-state">No departments found.</p>
                            @else
                                <ul class="list-group">
                                    @foreach ($departments as $department)
                                        <li class="list-group-item">
                                            {{ $department->name }}
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                    {{-- qualifications Section --}}
                    <div class="card settings-card">
                        <div class="card-header">
                            <h5>Qualifications</h5>
                            <button class="btn btn-primary" onclick="$('#qualificationModal').modal('show');">Add
                                Qualification</button>
                            {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#departmentModal">Add Department</button> --}}
                        </div>
                        <div class="card-body">
                            @if ($departments->isEmpty())
                                <p class="empty-state">No Qualifications found.</p>
                            @else
                                <ul class="list-group">
                                    @foreach ($qualifications as $qualification)
                                        <li class="list-group-item">
                                            {{ $qualification->name }}
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals for Adding Categories, Roles, and Departments --}}

    <!-- Category Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('settings.storeCategory') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryModalLabel">Add Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Category Name Input -->
                        <input type="text" name="name" class="form-control" placeholder="Category Name" required>

                        <!-- Description Input -->
                        <textarea name="description" class="form-control mt-3" placeholder="Category Description"></textarea>

                        <!-- Is Credit Checkbox -->
                        <div class="form-check mt-3">
                            <input type="checkbox" name="is_credit" class="form-check-input" id="isCredit">
                            <label class="form-check-label" for="isCredit">Is Credit?</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            onclick="$('#categoryModal').modal('hide');">Close</button>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Type Modal -->
    <div class="modal fade" id="typeModal" tabindex="-1" role="dialog" aria-labelledby="typeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('settings.storeType') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="typeModalLabel">Add Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Type Name Input -->
                        <input type="text" name="name" class="form-control" placeholder="Type Name" required>

                        <!-- Description Input -->
                        <textarea name="description" class="form-control mt-3" placeholder="Type Description"></textarea>

                        <!-- Category Dropdown -->
                        <select name="category_id" class="form-control mt-3" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            onclick="$('#typeModal').modal('hide');">Close</button>
                        <button type="submit" class="btn btn-primary">Add Type</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Role Modal -->
    <div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('settings.storeRole') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="roleModalLabel">Add Role</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                    </div>
                    <div class="modal-body">
                        <input type="text" name="name" class="form-control" placeholder="Role Name" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            onclick="$('#roleModal').modal('hide');">Close</button>
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-primary">Add Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Department Modal -->
    <div class="modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-labelledby="departmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('settings.storeDepartment') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="departmentModalLabel">Add Department</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                    </div>
                    <div class="modal-body">
                        <input type="text" name="name" class="form-control" placeholder="Department Name"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            onclick="$('#departmentModal').modal('hide');">Close</button>
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-primary">Add Department</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <!-- Qualification Modal -->
     <div class="modal fade" id="qualificationModal" tabindex="-1" role="dialog" aria-labelledby="qualificationModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form action="{{ route('settings.storeQualification') }}" method="POST">
                 @csrf
                 <div class="modal-header">
                     <h5 class="modal-title" id="qualificationModalLabel">Add Qualification</h5>
                     {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button> --}}
                 </div>
                 <div class="modal-body">
                     <input type="text" name="name" class="form-control" placeholder="Qualification Name"
                         required>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary"
                         onclick="$('#qualificationModal').modal('hide');">Close</button>
                     {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                     <button type="submit" class="btn btn-primary">Add Qualification</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

@endsection
