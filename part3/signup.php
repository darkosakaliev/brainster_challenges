<?php
include 'functions.php';
session_start();

if (isset($_POST['submit'])) {

    if (emptyErr($_POST['email']) == false && emptyErr($_POST['username']) == false && emptyErr($_POST['password']) == false) {
        if (userVal($_POST['username']) == false) {
            if (passVal($_POST['password']) == false) {
                if (emailVal($_POST['email']) == false) {
                    checkPost();
                    $email = $_POST['email'];
                    $username = $_POST['username'];
                    $_SESSION['username'] = $username;
                    $password = $_POST['password'];
                    $password = md5($password);

                    checkUserUnique($username);
                    checkMailUnique($email);

                    if (file_put_contents("users.txt", "$email, $username=$password" . PHP_EOL, FILE_APPEND)) {
                        redirect(WELCOME_PAGE, "success=register");
                    }

                    redirect(REGISTER_PAGE, "error=general");
                }
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        <div>
        </div>
        <div class="container">
            <h2 class="text-center mb-5">Sign Up form</h2>
            <form action="" method="POST">
                <div class="form-group row justify-content-center">
                    <div class="col-sm-6">
                        <input type="email" class="form-control form-control-lg" name="email" placeholder="Email">
                        <?php checkAndPrintErrorMessage(); 
                        if (isset($_POST['email']) && emailVal($_POST['email']) == true) echo '<p class="text-danger">Email must have at least 5 characters before @.</p>';
                        ?>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-lg" name="username" placeholder="Username">
                        <?php checkAndPrintErrorMessage();
                        if (isset($_POST['username']) && userVal($_POST['username']) == true) echo '<p class="text-danger">Username cannot contain empty spaces or special signs.</p>';
                        ?>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <div class="col-sm-6">
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                        <?php checkAndPrintErrorMessage();
                        if (isset($_POST['password']) && passVal($_POST['password']) == true) echo '<p class="text-danger">Password must have at least one number, one special sign and one
                              uppercase letter</p>';
                        ?>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg px-5">Register</button>
                </div>
            </form>
        </div>
</body>

</html>