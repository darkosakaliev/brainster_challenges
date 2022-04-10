<?php

ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );

require_once __DIR__ . '/conn.php';


if(isset($_POST['search'])) {

    $search = $_POST['searchParam'];

    $sqlSearch = "SELECT r.id, m.model, t.type, r.vehicle_chassis, r.vehicle_year, r.vehicle_reg_num, f.type as f_type, r.registration_to FROM registrations r INNER JOIN vehicle_models m ON r.vehicle_model = m.id INNER JOIN vehicle_type t ON r.vehicle_type = t.id INNER JOIN fuel_type f ON r.vehicle_fuel = f.id WHERE m.model LIKE ? OR r.vehicle_chassis LIKE ? OR r.vehicle_reg_num LIKE ?;";
    $stmtSearch = $pdo->prepare($sqlSearch);
    $stmtSearch->execute(["%".$search."%", "%".$search."%", "%".$search."%"]);
    print_r($stmtSearch->fetch());
}


?>


<!DOCTYPE html>
<html>
    <head>
        <title>Document</title>
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
    <form class="mt-5 d-flex" action="" method="POST">
            <input type="text" id="searchParam" name="searchParam" class="form-control form-control-lg" placeholder="Search">
            <button class="ml-4 btn btn-primary btn-lg d-inline" type="submit" id="search" name="search">Search</button>
            </form>
        
    <div class="col-12 mt-5">
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
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($cars = $stmtSearch->fetch()) { ?>
                    <tr class="<?php
                                if (strtotime($cars['registration_to']) < strtotime('today')) {
                                    echo "text-danger";
                                } else if (strtotime($cars['registration_to']) < strtotime('+1 month')) echo "text-warning";
                                ?>">
                        <td><?= $cars['id'] ?></td>
                        <td><?= $cars['model'] ?></td>
                        <td><?= $cars['type'] ?></td>
                        <td><?= $cars['vehicle_chassis'] ?></td>
                        <td><?= $cars['vehicle_year'] ?></td>
                        <td><?= $cars['vehicle_reg_num'] ?></td>
                        <td><?= $cars['f_type'] ?></td>
                        <td><?= $cars['registration_to'] ?></td>
                        <td colspan="4">
                            <form class="d-inline" action="" method="post">
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="id" value="<?= $cars['id'] ?>">
                                <button type="submit" class="btn btn-warning">Edit</button>
                            </form>
                            <form class="d-inline" action="" method="post">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $cars['id'] ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <?php if ((strtotime($cars['registration_to']) < strtotime('today')) || (strtotime($cars['registration_to']) < strtotime('+1 month'))) { ?>
                                <form class="d-inline" action="" method="post">
                                    <input type="hidden" name="action" value="extend">
                                    <input type="hidden" name="id" value="<?= $cars['id'] ?>">
                                    <button type="submit" class="btn btn-success">Extend</button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
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