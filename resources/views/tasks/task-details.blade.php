@extends('layouts.master')

@section('content')
<div class="page-container">
    @include('layouts.components.sidebar', ['page' => 'Tasks'])

    <div class="page-content">
        @include('layouts.components.page-header', ['title' => 'Task Details'])

        <div class="main-wrapper">
            <div class="card">
                <div class="card-body">
                    <h3>{{ $task->title }}</h3>
                    <p><strong>Description:</strong> {{ $task->description }}</p>
                    <p><strong>Assigned Staff:</strong> {{ $task->staff->name }}</p>
                    <p><strong>Priority:</strong> {{ ucfirst($task->priority) }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
                    <p><strong>Due Date:</strong> {{ $task->due_date }}</p>

                    <a href="{{ route('tasks.edit', $task->task_id) }}" class="btn btn-warning">Edit Task</a>
                    <a href="{{ route('tasks') }}" class="btn btn-secondary">Back to Tasks</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
