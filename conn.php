<?php

$servername = "localhost";
$dbname = "challenge17";
$username = "root";
$password = "";

try {
  $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,
    [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
);
} catch(PDOException $e) {
  echo "Connection failed.";
}