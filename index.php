<?php

require_once __DIR__ . '/conn.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Challenge 17</title>
    <meta charset="utf-8" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <!-- Latest compiled and minified Bootstrap 4.4.1 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Latest Font-Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Vehicle Registration</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="jumbotron mt-3">
            <p class="display-4 text-center">Vehicle Registration</p>
            <p class="lead text-center">Enter your registration number to check its validity.</p>
            <form action="" method="POST">
                <input type="text" class="form-control w-50 mx-auto" name="reg_num" id="reg_num" placeholder="Registration number">
                <button type="submit" class="btn btn-primary mt-4 mx-auto btn-block w-25" name="search" id="search">Search</button>
            </form>
        </div>
        <?php
        if (isset($_POST['search'])) {

            $sqlSearch = "SELECT r.id, m.model, t.type, r.vehicle_chassis, r.vehicle_year, r.vehicle_reg_num, f.type as f_type, r.registration_to FROM registrations r INNER JOIN vehicle_models m ON r.vehicle_model = m.id INNER JOIN vehicle_type t ON r.vehicle_type = t.id INNER JOIN fuel_type f ON r.vehicle_fuel = f.id WHERE r.vehicle_reg_num = :reg_num";
            $stmtSearch = $pdo->prepare($sqlSearch);
            $executed = $stmtSearch->execute([
                'reg_num' => $_POST['reg_num']
            ]);
        ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>vehicle model</th>
                        <th>vehicle type</th>
                        <th>vehicle chassis number</th>
                        <th>vehicle production year</th>
                        <th>registration number</th>
                        <th>fuel type</th>
                        <th>registration to</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($search = $stmtSearch->fetch()) { ?>
                        <tr>
                            <td><?= $search['id'] ?></td>
                            <td><?= $search['model'] ?></td>
                            <td><?= $search['type'] ?></td>
                            <td><?= $search['vehicle_chassis'] ?></td>
                            <td><?= $search['vehicle_year'] ?></td>
                            <td><?= $search['vehicle_reg_num'] ?></td>
                            <td><?= $search['f_type'] ?></td>
                            <td><?= $search['registration_to'] ?></td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td colspan="8">No records found.</td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
    </div>


    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <!-- Latest Compiled Bootstrap 4.4.1 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>