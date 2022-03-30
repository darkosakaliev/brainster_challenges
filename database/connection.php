<?php
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=localhost;dbname=challenge16", $username, $password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
  } catch(PDOException $e) {
    echo "Connection failed.";
    die();
  }