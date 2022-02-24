<?php

define("INDEX_PAGE", "index.php");
define("REGISTER_PAGE", "signup.html");
define("LOGIN_PAGE", "login.html");
define("WELCOME_PAGE", "welcome.php");

function checkPost() {
    if($_SERVER['REQUEST_METHOD'] != "POST") {
        redirect(INDEX_PAGE);
    } 
}

function checkUserUnique($username) {
    $data = file_get_contents('users.txt');
    $users = explode(PHP_EOL, $data);
    foreach($users as $user) {
        $userData = explode("=", $user);
        if(strtolower($userData[0]) == strtolower($username)) {
            redirect(INDEX_PAGE, "error=usernametaken");
        }
    }
}

function checkMailUnique($email) {
    $data = file_get_contents('users.txt');
    $users = explode(PHP_EOL, $data);
    foreach($users as $user) {
        $userData = explode(", ", $user);
        if(strtolower($userData[0]) == strtolower($email)) {
            redirect(INDEX_PAGE, "warning=mailtaken");
        }
    }
}

function checkAndPrintErrorMessage() {
    $errorMsg = [
        'notfound' => 'Wrong username/password combination',
        'general' => 'An error occured. Please try again later.',
        'usernametaken' => 'Username is already taken.',
        'mailtaken' => 'A user with this email already exists.'
    ];

    if(isset($_GET['error'])) {
        echo '<p class="alert alert-danger">'. $errorMsg[$_GET['error']]  .'</p>';
    }

    if(isset($_GET['warning'])) {
        echo '<p class="alert alert-warning">'. $errorMsg[$_GET['warning']]  .'</p>';
    }
}

function checkAndPrintSuccessMessage() {
    $successMsg = [
        'login' => 'Successful login.',
        'register' => 'Successful registration.'
    ];
    if(isset($_GET['success'])) {
        echo '<p class="alert alert-success">'.$successMsg[$_GET['success']].'</p>';
    }
}

function redirect($url, $queryString = '') {
    if($queryString != '') {
        $url .= "?$queryString";
    }

    header("Location:". $url);
    die();
}