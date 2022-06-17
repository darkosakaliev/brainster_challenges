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
                    OUT</a>
            </li>
        @else
            <li><a class="me-4 text-decoration-none text-white fw-bold fs-5 {{ request()->is('login') ? 'active' : '' }}"
                    href="{{ route('login') }}">LOG IN</a></li>
        @endif
    </ul>


    <form class="container text-white my-5" action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-5">
            <label for="first_name" class="form-label fw-bold">FIRST NAME</label>
            <input type="text" class="form-control" name="first_name" id="first_name">
            @error('first_name')
                <div class="alert alert-danger p-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="last_name" class="form-label fw-bold">LAST NAME</label>
            <input type="text" class="form-control" name="last_name" id="last_name">
            @error('last_name')
                <div class="alert alert-danger p-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="email" class="form-label fw-bold">EMAIL</label>
            <input type="text" class="form-control" name="email" id="email">
            @error('email')
                <div class="alert alert-danger p-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Login</button>
        </div>
    </form>

    <div class="bg-darkbrown text-white p-4 text-center">
        <p class="m-0">Copyright @ Your Website 2022</p>
    </div>
</body>

</html>
