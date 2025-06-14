<!DOCTYPE html>
<html>
<head>
    <title>Account Created</title>
</head>
<body>
    <p>Hello {{ $user->voornaam }},</p>

    <p>Your account has been created. Please set your password by clicking the link below:</p>

    <p><a href="{{ $url }}">Set Your Password</a></p>

    <p>This link is secure and will expire (according to your signed URL expiration settings).</p>

    <p>Thank you!</p>
</body>
</html>
