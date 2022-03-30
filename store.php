<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once __DIR__ . '/./database/connection.php';

    $data = $_POST;

    $sql = "INSERT INTO `users` (coverurl, maintitle, subtitle, bio, telnumber, location, typeofbsn, produrl, proddesc, produrltwo, proddesctwo, produrlthree, proddescthree, compdesc, linkedin, facebook, twitter, instagram) 
    VALUES  (:coverurl, :maintitle, :subtitle, :bio, :telnumber, :location, :typeofbsn, :produrl, :proddesc, :produrltwo, :proddesctwo, :produrlthree, :proddescthree, :compdesc, :linkedin, :facebook, :twitter, :instagram)";

    $stmt = $pdo->prepare($sql);

    $executed = $stmt->execute($data);


    if ($executed) {
        $lastid = $pdo->lastInsertId();
        header("Location: company.php?id=$lastid");
        die();
    } else {
        header("Location: index.html");
        die();
    }
}