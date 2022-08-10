<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<p>
    Hi {{ $name }},
</p>
<p>
This is an account activation email - visit this <a href="{{ route('activateToken', [$email, $token]) }}">link</a> to activate your account at our application!
<br>
Note: This link will expire in 24 hours, be sure to activate your account till then!
</p>
<p>
    Cheers!
</p>
</body>
</html>
