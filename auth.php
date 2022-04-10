<?php

session_start();


if($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once __DIR__ . '/conn.php';

    $username = $_POST['username'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM `admins` WHERE `username` = :username";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'username' => $username
    ]);

    if($stmt->rowCount() == 1) {
        $user = $stmt->fetch();

        if(password_verify($password, $user['pass'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            die();
        } else {
            $_SESSION['error'] = "Wrong credentials.";

            header("Location: login.php");
            die();
        }
    } else {
        $_SESSION['error'] = "User not found.";

        header("Location: login.php");
    }
} else {
    header("Location: index.php");
    die();
}