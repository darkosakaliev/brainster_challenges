<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge-22</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
    body {
        background: linear-gradient(rgba(127, 67, 49, 0.7), rgba(127, 67, 49, 0.7)), url("{{ asset('images/textures/coffeebeans.jpg') }}");
    }

    .bg-darkbrown {
        background-color: rgb(63, 37, 0);
    }

    .bg-yellow {
        background-color: rgb(255, 149, 0);
    }

    .active {
        color: rgb(255, 149, 0) !important;
    }
</style>

<body>
    <h1 class="text-center text-white fw-bold display-2 py-4">BUSINESS CASUAL</h1>
    <ul class="list-unstyled bg-darkbrown py-4 d-flex justify-content-center">
        <li><a class="me-4 text-decoration-none text-white fw-bold fs-5 {{ request()->is('/') ? 'active' : '' }}"
                href="{{ route('home') }}">HOME</a></li>
        @if (session()->has('user'))
            <li><a class="text-decoration-none text-white fw-bold fs-5" href="{{ route('users.destroy') }}">LOG
                    OUT</a></li>
        @else
            <li><a class="me-4 text-decoration-none text-white fw-bold fs-5 {{ request()->is('login') ? 'active' : '' }}"
                    href="{{ route('login') }}">LOG IN</a></li>
        @endif
    </ul>
    <h2 class="text-white mb-5 mt-5">Your First name is: {{ $user['first_name'] }}</h2>
    <h2 class="text-white mb-5">Your Last name is: {{ $user['last_name'] }}</h2>
    @if (session()->has('user.email'))
    <h2 class="text-white mb-5">Your E-Mail is: {{ $user['email'] }}</h2>
    @endif
</body>

</html>
