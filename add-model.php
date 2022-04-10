<?php

require_once __DIR__ . '/conn.php';

session_start();

require_once __DIR__ . '/conn.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    die();
}

if(isset($_POST['add'])) {
    $vModel = $_POST['vehicle_model'];

    $sqlVal = "SELECT * FROM `vehicle_models` WHERE model = :model LIMIT 1;";
    $stmtVal = $pdo->prepare($sqlVal);
    $stmtVal->execute([
        'model' => $vModel
    ]);

    if($stmtVal->rowCount() > 0) {
        $messages['error'] = "This vehicle model already exists.";
    } else {

    $sqlAdd = "INSERT INTO vehicle_models(model) VALUES (:model);";
    $stmtAdd = $pdo->prepare($sqlAdd);
    $executed = $stmtAdd->execute([
        'model' => $vModel
    ]);

    if($executed) {
        header("Location: dashboard.php?model=added");
    } else {
        header("Location: dashboard.php?error=true");
    }
}
}

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
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="jumbotron mt-3">
            <p class="display-4 text-center">Vehicle Registration</p>
            <div class="row">
            <div class="col">
                <?php if (isset($messages['success']) && !empty($messages['success'])) { ?>
                    <div class="alert alert-success">
                        <?= $messages['success']; ?>
                    </div>
                <?php } elseif (isset($messages['error']) && !empty($messages['error'])) { ?>
                    <div class="alert alert-danger">
                        <?= $messages['error']; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
            <p class="lead text-center">Add Vehicle Model</p>
            <form action="" method="POST">
                <input type="text" class="form-control w-50 mx-auto" name="vehicle_model" id="vehicle_model" placeholder="Vehicle Model">
                <button type="submit" class="btn btn-primary mt-4 mx-auto btn-block w-25" name="add" id="add">Add</button>
            </form>
        </div>
    </div>


    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <!-- Latest Compiled Bootstrap 4.4.1 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>