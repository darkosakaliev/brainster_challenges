<?php
include "functions.php";
session_start();

if (isset($_POST['submit'])) {
    checkPost();
    $username = $_POST['username'];
    $_SESSION['username'] = $username;
    $password = $_POST['password'];

    $data = file_get_contents("users.txt");
    $users = explode(PHP_EOL, $data);

    $password = md5($password);

    foreach ($users as $user) {
        if ($user == "$username=$password") {
            redirect(WELCOME_PAGE, "success=login");
        }
    }

    redirect(INDEX_PAGE, "error=notfound");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            background-image: url(https://img.freepik.com/free-vector/hand-painted-watercolor-pastel-sky-background_23-2148902771.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="d-flex vh-100 justify-content-center align-items-center">
        <div class="container">
            <h2 class="text-center mb-5">Login form</h2>
            <form action="" method="POST">
                <div class="form-group row justify-content-center">
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-lg" name="username" placeholder="Username">
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <div class="col-sm-6">
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg px-5">Login</button>
                </div>
            </form>
        </div>
</body>

</html>