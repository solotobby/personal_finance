<!DOCTYPE html>
<html>
<head>
    <title>Welcome to the Team</title>
</head>
<body>
    <h2>Hi {{ $staff->name }},</h2>
    <p>Your account has been created successfully.</p>
    <p>Login using your email: <strong>{{ $staff->email }}</strong></p>
    <p>Login using your One Time Password: <strong>{{ $staff->password }}</strong></p>
</body>
</html>
