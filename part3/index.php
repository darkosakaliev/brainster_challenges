<?php
include 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge 13 - PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            background-image: url(https://img.freepik.com/free-vector/hand-painted-watercolor-pastel-sky-background_23-2148902771.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }

        .alert {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="d-flex vh-100 justify-content-center align-items-center">
        <div>
            <?php
            checkAndPrintSuccessMessage();
            checkAndPrintErrorMessage();
            ?>
        </div>
        <a href="login.php" class="btn btn-primary btn-lg mr-3">Login</a>
        <a href="signup.php" class="btn btn-primary btn-lg">Sign up</a>
    </div>
</body>

</html>