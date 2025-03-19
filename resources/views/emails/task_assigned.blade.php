<!DOCTYPE html>
<html>
<head>
    <title>New Task Assigned</title>
</head>
<body>
    <h2>Hi {{ $task->staff->name }},</h2>
    <p>You have been assigned a new task: <strong>{{ $task->title }}</strong></p>
    <p>Due Date: <strong>{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}</strong></p>
    <p>Description: {{ $task->description }}</p>
</body>
</html>
