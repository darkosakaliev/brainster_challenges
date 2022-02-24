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

function checkAndPrintErrorMessage() {
    $errorMsg = [
        'notfound' => 'Wrong username/password combination',
        'general' => 'An error occured. Please try again later.'
    ];

    if(isset($_GET['error'])) {
        echo '<p class="alert alert-danger">'. $errorMsg[$_GET['error']]  .'</p>';
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