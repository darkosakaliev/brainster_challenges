<?php
session_start();

require_once __DIR__ . '/conn.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    die();
}

$messages = [
    'error' => '',
    'success' => ''
];

if (isset($_POST['create'])) {
    if (
        isset($_POST['vehicle_model']) &&
        isset($_POST['vehicle_type']) &&
        isset($_POST['vehicle_chassis']) &&
        isset($_POST['vehicle_year']) &&
        isset($_POST['vehicle_reg_num']) &&
        isset($_POST['fuel_type']) &&
        isset($_POST['registration_to'])
    ) {

            $sqlVal = "SELECT * FROM `registrations` WHERE vehicle_chassis = :vehicle_chassis LIMIT 1;";
            $stmtVal = $pdo->prepare($sqlVal);
            $stmtVal->execute([
                'vehicle_chassis' => $_POST['vehicle_chassis']
            ]);

            if($stmtVal->rowCount() > 0) {
                $messages['error'] = "This chassis already exists.";
            } else {

                    $sqlCreate = "INSERT INTO `registrations`(vehicle_model, vehicle_type, vehicle_chassis, vehicle_year, vehicle_reg_num, vehicle_fuel, registration_to) VALUES (:vehicle_model, :vehicle_type, :vehicle_chassis, :vehicle_year, :vehicle_reg_num, :vehicle_fuel, :registration_to)";
                    $stmtCreate = $pdo->prepare($sqlCreate);
                    $executed = $stmtCreate->execute([
                        'vehicle_model' => $_POST['vehicle_model'],
                        'vehicle_type' => $_POST['vehicle_type'],
                        'vehicle_chassis' => $_POST['vehicle_chassis'],
                        'vehicle_year' => $_POST['vehicle_year'],
                        'vehicle_reg_num' => $_POST['vehicle_reg_num'],
                        'vehicle_fuel' => $_POST['fuel_type'],
                        'registration_to' => $_POST['registration_to']
                    ]);

                    if ($executed) {
                        $messages['success'] = "Vehicle added sucessfully.";
                    } else {
                    $messages['error'] = "An error occurred.";
                    }
                }
        }
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'delete') {
        $sqlDelete = "DELETE FROM registrations WHERE id = :id LIMIT 1";
        $stmtDelete = $pdo->prepare($sqlDelete);
        $executed = $stmtDelete->execute([
            'id' => $_POST['id']
        ]);

        if ($executed) {
            $messages['success'] = "Registration deleted.";
        } else {
            $messages['error'] = "An error occured.";
        }
    } else if ($_POST['action'] == 'edit' || $_POST['action'] == 'extend') {
        $sqlEdit = "SELECT r.id, m.id as model_id, m.model, t.id as type_id, t.type, r.vehicle_chassis, r.vehicle_year, r.vehicle_reg_num, f.id as fuel_id, f.type as f_type, r.registration_to FROM registrations r INNER JOIN vehicle_models m ON r.vehicle_model = m.id INNER JOIN vehicle_type t ON r.vehicle_type = t.id INNER JOIN fuel_type f ON r.vehicle_fuel = f.id WHERE r.id = :id LIMIT 1;";
        $stmtEdit = $pdo->prepare($sqlEdit);
        $stmtEdit->execute([
            'id' => $_POST['id']
        ]);

        if($_POST['action'] == 'edit') {
            if ($stmtEdit->rowCount() == 1) {
                $edit_form = $stmtEdit->fetch();
            }
        }
        else if ($_POST['action'] == 'extend') {
            if ($stmtEdit->rowCount() == 1) {
            $extend_form = $stmtEdit->fetch();
            }
        }
        } else if ($_POST['action'] == 'update') {

        $sqlUpdate = "UPDATE `registrations` SET vehicle_model = :vehicle_model, vehicle_type = :vehicle_type, vehicle_chassis = :vehicle_chassis, vehicle_year = :vehicle_year, vehicle_reg_num = :vehicle_reg_num, vehicle_fuel = :vehicle_fuel WHERE id = :id;";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $executed = $stmtUpdate->execute(
            [
                'vehicle_model' => $_POST['vehicle_model'],
                'vehicle_type' => $_POST['vehicle_type'],
                'vehicle_chassis' => $_POST['vehicle_chassis'],
                'vehicle_year' => $_POST['vehicle_year'],
                'vehicle_reg_num' => $_POST['vehicle_reg_num'],
                'vehicle_fuel' => $_POST['fuel_type'],
                'id' => $_POST['id']
            ]
        );

        if ($executed) {
            $messages['success'] = "Registration updated.";
        } else {
            $messages['error'] = "An error occured.";
        }
    } else if ($_POST['action'] == 'extendreg') {

                $sqlExtend = "UPDATE `registrations` SET registration_to = :registration_to WHERE id = :id;";
                $stmtExtend = $pdo->prepare($sqlExtend);
                $exec = $stmtExtend->execute([
                    'registration_to' => $_POST['registration_to'],
                    'id' => $_POST['id']
                ]);
    
                if ($exec) {
                    $messages['success'] = "Registration extended.";
                } else {
                    $messages['error'] = "An error occured.";
                }
    }
}

$sqlCars = "SELECT r.id, m.model, t.type, r.vehicle_chassis, r.vehicle_year, r.vehicle_reg_num, f.type as f_type, r.registration_to FROM registrations r INNER JOIN vehicle_models m ON r.vehicle_model = m.id INNER JOIN vehicle_type t ON r.vehicle_type = t.id INNER JOIN fuel_type f ON r.vehicle_fuel = f.id;";
$sqlModels = "SELECT * FROM vehicle_models WHERE 1";
$sqlvType = "SELECT * FROM vehicle_type WHERE 1";
$sqlfType = "SELECT * FROM fuel_type WHERE 1";

$stmtCars = $pdo->query($sqlCars);
$stmtModels = $pdo->query($sqlModels);
$stmtvType = $pdo->query($sqlvType);
$stmtfType = $pdo->query($sqlfType);

if(isset($_POST['search'])) {

    $search = $_POST['searchParam'];

    $sqlSearch = "SELECT r.id, m.model, t.type, r.vehicle_chassis, r.vehicle_year, r.vehicle_reg_num, f.type as f_type, r.registration_to FROM registrations r INNER JOIN vehicle_models m ON r.vehicle_model = m.id INNER JOIN vehicle_type t ON r.vehicle_type = t.id INNER JOIN fuel_type f ON r.vehicle_fuel = f.id WHERE m.model LIKE ? OR r.vehicle_chassis LIKE ? OR r.vehicle_reg_num LIKE ?;";
    $stmtSearch = $pdo->prepare($sqlSearch);
    $stmtSearch->execute(["%".$search."%", "%".$search."%", "%".$search."%"]);
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
        <p class="display-4 text-center">Vehicle Registration</p>
        <div class="row">
            <div class="col">
                <?php if (isset($messages['success']) && !empty($messages['success'])) { ?>
                    <div class="alert alert-success">
                        <?= $messages['success']; ?>
                    </div>
                <?php } else if (isset($messages['error']) && !empty($messages['error'])) { ?>
                    <div class="alert alert-danger">
                        <?= $messages['error']; ?>
                    </div>
                <?php } else if (isset($_GET['model'])) { ?>
                    <div class="alert alert-success">
                        Vehicle model added successfully.
                    </div>
                    <?php } else if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger">
                        An error occured.
                    </div>
                    <?php } ?>
                </div>
        </div>
        <form method="POST" action="">
            <div class="row">
                <div class="col">
                    <?php if (isset($edit_form)) { ?>
                        <input type="hidden" name="id" value="<?= $edit_form['id'] ?>">
                        <input type="hidden" name="action" value="update">
                    <?php } else if (isset($extend_form)) { ?>
                        <input type="hidden" name="id" value="<?= $extend_form['id'] ?>">
                        <input type="hidden" name="action" value="extendreg">
                    <?php } else { ?>
                        <input type="hidden" name="action" value="create">
                    <?php } ?>
                    <label for="vehicle_model">Vehicle Model: <a href="add-model.php">Model missing? Add one!</a></label>
                    <select class="form-control" id="vehicle_model" name="vehicle_model" <?php if(isset($extend_form)) {echo "disabled";} ?>>
                    <option value="" selected disabled>Default Select</option>
                        <?php while ($row = $stmtModels->fetch()) { ?>
                            <option value="<?= $row['id'] ?>"><?= $row['model'] ?></option>
                        <?php } ?>
                        <?php if (isset($edit_form)) { ?>
                            <option value="<?= $edit_form['model_id'] ?>" selected><?= $edit_form['model'] ?></option>
                        <?php } else if (isset($extend_form)) { ?>
                            <option value="<?= $extend_form['model_id'] ?>" selected><?= $extend_form['model'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col">
                    <label for="vehicle_type">Vehicle Type: </label>
                    <select class="form-control" id="vehicle_type" name="vehicle_type" <?php if(isset($extend_form)) {echo "disabled";} ?>>
                        <option value="" selected disabled>Default Select</option>
                        <?php while ($row = $stmtvType->fetch()) { ?>
                            <option value="<?= $row['id'] ?>"><?= $row['type'] ?></option>
                        <?php } ?>
                        <?php if (isset($edit_form)) { ?>
                            <option value="<?= $edit_form['type_id'] ?>" selected><?= $edit_form['type'] ?></option>
                        <?php } else if (isset($extend_form)) { ?>
                            <option value="<?= $extend_form['type_id'] ?>" selected><?= $extend_form['type'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="vehicle_chassis">Vehicle Chassis Number: </label>
                    <input type="text" class="form-control" id="vehicle_chassis" name="vehicle_chassis" <?php if(isset($edit_form)) {echo 'value="' . $edit_form['vehicle_chassis'] . '"' ;} else if (isset($extend_form)) {echo 'disabled value="' . $extend_form['vehicle_chassis'] . '"';} ?>>
                </div>
                <div class="col">
                    <label for="vehicle_year">Vehicle Production Year: </label>
                    <input type="date" class="form-control" name="vehicle_year" id="vehicle_year" <?php if(isset($edit_form)) {echo 'value="' . $edit_form['vehicle_year'] . '"' ;} else if (isset($extend_form)) {echo 'disabled value="' . $extend_form['vehicle_year'] . '"';} ?>>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="vehicle_reg_num">Vehicle Registration Number: </label>
                    <input type="text" class="form-control" id="vehicle_reg_num" name="vehicle_reg_num" <?php if(isset($edit_form)) {echo 'value="' . $edit_form['vehicle_reg_num'] . '"' ;} else if (isset($extend_form)) {echo 'disabled value="' . $extend_form['vehicle_reg_num'] . '"';} ?>>
                </div>
                <div class="col">
                    <label for="fuel_type">Fuel Type: </label>
                    <select class="form-control" name="fuel_type" id="fuel_type" <?php if(isset($extend_form)) {echo "disabled";} ?>>
                        <option value="" selected disabled>Default Select</option>
                        <?php while ($row = $stmtfType->fetch()) { ?>
                            <option value="<?= $row['id'] ?>"><?= $row['type'] ?></option>
                        <?php } ?>
                        <?php if (isset($edit_form)) { ?>
                            <option value="<?= $edit_form['fuel_id'] ?>" selected><?= $edit_form['f_type'] ?></option>
                        <?php } else if (isset($extend_form)) { ?>
                            <option value="<?= $extend_form['fuel_id'] ?>" selected><?= $extend_form['f_type'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="registration_to">Registration To: </label>
                    <input type="date" class="form-control" id="registration_to" name="registration_to" <?php if(isset($edit_form)) {echo 'disabled value="' . $edit_form['registration_to'] . '"' ;} else if (isset($extend_form)) {echo 'value="' . $extend_form['registration_to'] . '"';} ?>>
                </div>
                <div class="col">
                    <label for="" class="invisible">Hidden</label>
                    <?php if (isset($edit_form)) { ?>
                        <button type="submit" class="btn btn-block btn-primary" id="update" name="update">Update</button>
                    <?php } else if (isset($extend_form)) { ?>
                        <button type="submit" class="btn btn-block btn-primary" id="extend" name="extendreg">Extend</button>
                    <?php } else { ?>
                        <button type="submit" class="btn btn-block btn-primary" id="create" name="create">Create</button>
                    <?php } ?>
                </div>
            </div>
        </form>
        <form class="mt-5 d-flex" action="" method="POST">
            <input type="text" id="searchParam" name="searchParam" class="form-control form-control-lg" placeholder="Search">
            <button class="ml-4 btn btn-primary btn-lg d-inline" type="submit" id="search" name="search">Search</button>
            </form>
    </div>
                
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
                <?php if(!isset($_POST['search'])) { ?>
                <?php while ($cars = $stmtCars->fetch()) { ?>
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
                <?php } else { ?>
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