<?php

define("INDEX_PAGE", "index.php");
define("REGISTER_PAGE", "signup.php");
define("LOGIN_PAGE", "login.php");
define("WELCOME_PAGE", "welcome.php");

function checkPost()
{
    if ($_SERVER['REQUEST_METHOD'] != "POST") {
        redirect(INDEX_PAGE);
    }
}

function emptyErr($data)
{
    if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
        redirect(REGISTER_PAGE, "valid=empty");
    }
}

function userVal($username)
{
    if (preg_match('/[!@#\$%\^&\*]+$/', $username)) {
        return false;
    }
    return true;
}

function passVal($password) {
    if( !preg_match('/[a-z]+/', $password)  
        || !preg_match('/[A-Z]+/', $password)
        || !preg_match('/[0-9]+/', $password)
        || !preg_match('/[!@#\$%\^&\*]+/', $password)
    ) {
        return true;
    }
    return false;
}

function emailVal($email) {
    $data = explode('@', $email);
    if (strlen($data[0]) < 5) {
        return true;
    }
    return false;
}

function checkUserUnique($username)
{
    $data = file_get_contents('users.txt');
    $users = explode(PHP_EOL, $data);
    foreach ($users as $user) {
        $userData = explode("=", $user);
        if (strtolower($userData[0]) == strtolower($username)) {
            redirect(INDEX_PAGE, "error=usernametaken");
        }
    }
}

function checkMailUnique($email)
{
    $data = file_get_contents('users.txt');
    $users = explode(PHP_EOL, $data);
    foreach ($users as $user) {
        $userData = explode(", ", $user);
        if (strtolower($userData[0]) == strtolower($email)) {
            redirect(INDEX_PAGE, "warning=mailtaken");
        }
    }
}

function checkAndPrintErrorMessage()
{
    $errorMsg = [
        'notfound' => 'Wrong username/password combination',
        'general' => 'An error occured. Please try again later.',
        'usernametaken' => 'Username is already taken.',
        'mailtaken' => 'A user with this email already exists.',
        'empty' => 'This field is required.'
    ];

    if (isset($_GET['valid'])) {
        echo '<p class="text-danger">' . $errorMsg[$_GET['valid']]  . '</p>';
    }

    if (isset($_GET['error'])) {
        echo '<p class="alert alert-danger">' . $errorMsg[$_GET['error']]  . '</p>';
    }

    if (isset($_GET['warning'])) {
        echo '<p class="alert alert-warning">' . $errorMsg[$_GET['warning']]  . '</p>';
    }
}

function checkAndPrintSuccessMessage()
{
    $successMsg = [
        'login' => 'Successful login.',
        'register' => 'Successful registration.'
    ];
    if (isset($_GET['success'])) {
        echo '<p class="alert alert-success">' . $successMsg[$_GET['success']] . '</p>';
    }
}

function redirect($url, $queryString = '')
{
    if ($queryString != '') {
        $url .= "?$queryString";
    }

    header("Location:" . $url);
    die();
}
