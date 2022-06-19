<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Challenge - 23</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/9f52a7ac5f.js" crossorigin="anonymous"></script>

    <style>
        .banner {
            height: 60vh;
            background-size: cover;
            background-position: center center;
        }

        .imgHome {
            background-image: linear-gradient(rgba(0, 0, 0, 0.527), rgba(0, 0, 0, 0.5)), url({{ asset('images/home-bg.jpg') }});
        }

        .imgAbout {
            background-image: linear-gradient(rgba(0, 0, 0, 0.527), rgba(0, 0, 0, 0.5)), url({{ asset('images/about-bg.jpg') }});
        }

        .imgBlog {
            background-image: linear-gradient(rgba(0, 0, 0, 0.527), rgba(0, 0, 0, 0.5)), url({{ asset('images/post-bg.jpg') }});
        }

        .imgContact {
            background-image: linear-gradient(rgba(0, 0, 0, 0.527), rgba(0, 0, 0, 0.5)), url({{ asset('images/contact-bg.jpg') }});
        }

        .active {
            font-weight: bold;
        }
    </style>
</head>

<body>
