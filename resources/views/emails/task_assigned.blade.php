<!DOCTYPE html>
<html>
<head>
    <title>New Task Assigned</title>
</head>
<body>
    <h3>Hi {{ $task->staff->name }},</h2>
        <br>
    <p>You have been assigned a new task titled: <strong>{{ $task->title }}</strong></p>
    <p>Description: {{ $task->description }}</p>
    <p>Due Date: <strong>{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}</strong></p>
    <p>Priority: {{ strtoupper($task->priority) }}</p>
    <p>Link: <strong><a href="{{ env('APP_URL') }}/login">{{ env('APP_URL') }}/login</a></strong></p>
</body>
</html>
