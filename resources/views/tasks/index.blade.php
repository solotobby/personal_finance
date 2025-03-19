    @extends('layouts.master')
    @section('body-class', '')
    @section('styles')
        <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
    @endsection

    @section('content')

        <div class="page-container">
            @include('layouts.components.sidebar', ['page' => 'Tasks'])

            <div class="page-content">
                @include('layouts.components.page-header', ['title' => 'Task List'])
                <div class="main-wrapper">

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5>Total Tasks</h5>
                                    <h2>{{ $total_tasks }}</h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5>Completed Tasks</h5>
                                    <h2>{{ $completed_tasks }}</h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-warning text-dark">
                                <div class="card-body">
                                    <h5>Pending Tasks</h5>
                                    <h2>{{ $pending_tasks }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <a href="{{ url('task/create') }}" class="btn btn-primary text-black-50">Create Task</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Staff</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Priority</th>
                                                    <th scope="col">Due Date</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tasks as $task)
                                                    <tr style="cursor: pointer;">
                                                        <td>{{ $task->title }}</td>
                                                        <td>{{ $task->staff->name }}</td>
                                                        <td>
                                                            <form action="{{ route('tasks.update', $task->task_id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <select name="status" onchange="this.form.submit()" class="form-select">
                                                                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                                </select>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('tasks.priority', $task->task_id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <select name="priority" onchange="this.form.submit()" class="form-select">
                                                                    <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                                                                    <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                                                    <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                                                                </select>
                                                            </form>
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}</td>

                                                        <td>
                                                            <a href="{{ route('tasks.edit', $task->task_id) }}" class="btn btn-success btn-sm">View Task</a>
                                                        </td>
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

            </div>
        </div>

    @endsection
