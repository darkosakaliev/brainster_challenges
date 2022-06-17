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

    .left {
        left: 100px;
        width: 30%;
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

    <div class="d-flex container mt-5 mb-4 justify-content-center align-items-center">
        <div class="bg-white opacity-75 rounded p-4 position-relative left">
            <p class="text-center">LOREM IPSUM</p>
            <h5 class="text-center">LOREM IPSUM</h5>
            <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure porro quod voluptas
                nam eius ipsam iste a quibusdam accusantium sed aspernatur voluptatibus laudantium, sint quae! Beatae
                perferendis a exercitationem atque.</p>
            <a href="" class="btn btn-warning opacity-100 position-absolute">Visit us Today</a>
        </div>
        <img class="img-fluid w-50" src="{{ asset('images/cafe.jpg') }}" alt="">
    </div>

    <div class="bg-warning my-5">
        <div class="container p-3 text-center">
            <div class="bg-white border border-3 border-white">
                <div class="border border-3 p-3 border-warning">
                    <p>OUR PROMISE</p>
                    @if (session()->has('user'))
                        <h4 class="text-uppercase">TO {{ $user['first_name'] }} {{ $user['last_name'] }}</h4>
                    @else
                        <h4 class="text-uppercase">to you</h4>
                    @endif
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero ipsa, est amet voluptatum veniam
                        rerum necessitatibus quaerat excepturi, a qui, atque maiores dolorem earum omnis sed illum
                        asperiores enim. Minus doloribus sit perferendis provident numquam cupiditate repellendus
                        possimus,
                        quae repellat saepe unde et, excepturi nisi, autem dolore quidem voluptate aliquam!</p>
                </div>
            </div>
        </div>
    </div>


    <div class="bg-darkbrown text-white p-4 text-center">
        <p class="m-0">Copyright @ Your Website 2022</p>
    </div>
</body>

</html>
