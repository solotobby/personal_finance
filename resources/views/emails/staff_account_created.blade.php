<!DOCTYPE html>
<html>
<head>
    <title>Welcome to the Team at {{ $staff->business->business_name }}</title>
</head>
<body>
    <h2>Hi {{ $staff->name }},</h2>
    <p>Your account has been created successfully.</p>
    <p>Login using your staff ID: <strong>{{ $staff->staff_id }}</strong></p>
    <p>Your temporary password: <strong>{{ $password }}</strong></p>
    <p>Link: <strong><a href="{{ env('APP_URL') }}/login">{{ env('APP_URL') }}/login</a></strong></p>

    <p>Make sure to change your password after logging in.</p>
</body>
</html>

