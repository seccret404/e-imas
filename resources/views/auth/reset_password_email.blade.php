<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
</head>

<body>
    <h1>Reset Password</h1>
    <p>Hello, {{ $user->name }}</p>
    <p>Please click the link below to reset your password:</p>
    <a href="{{ route('password.reset', ['token' => $token]) }}">Reset Password</a>
    <p>If you did not request a password reset, no further action is required.</p>
</body>

</html>
