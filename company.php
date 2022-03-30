<?php

require_once __DIR__ . "/database/connection.php";

$id = $_GET['id'];

$sql = "SELECT `users`.*
            FROM `users`
            WHERE `users`.`id` = :id
            LIMIT 1";


$stmt = $pdo->prepare($sql);

$stmt->execute([
    'id' => $id
]);

if($stmt->rowCount() == 0) {
    header("Location: index.html");
    die();
}

$user = $stmt->fetch();

if($user['typeofbsn'] == 1) {
    $user['typeofbsn'] = "Services";
}
else if($user['typeofbsn'] == 2) {
    $user['typeofbsn'] = "Products";
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Challenge</title>
    <meta charset="utf-8" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9c48d6723e.js" crossorigin="anonymous"></script>
<style>
        * {
            box-sizing: border-box;
        }

        .bg {
            min-height: 100%;
            background: url("<?= $user['coverurl'] ?>"), rgba(0, 0, 0, 0.6);
            background-size: cover;
        }

        h1, h2 {
            text-shadow: 5px 5px 10px black;
        }

        nav-item:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Webster</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#aboutUs">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services"><?= $user['typeofbsn'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
        </div>
    </nav>
    <div class="bg vh-100 d-flex flex-column justify-content-around align-items-center">
        <h1 class="text-white"><?= $user['maintitle'] ?></h1>
        <h2 class="text-white"><?= $user['subtitle'] ?></h2>
    </div>
    <div id="aboutUs" class="container my-3">
        <h3 class="text-center">About Us</h3>
        <p class="text-center w-50 mx-auto"><?= $user['bio'] ?></p>
        <hr>
        <p class="text-center">Tel: <?= $user['telnumber'] ?> </p>
        <p class="text-center">Location: <?= $user['location'] ?></p>
    </div>
    <div id="services" class="container my-3">
        <h3 class="text-left"><?= $user['typeofbsn'] ?></h3>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <img class="card-img-top" src="<?= $user['produrl'] ?>" alt="Card image cap">
                    <div class="card-body bg-dark text-white">
                        <h5 class="card-title"><?= $user['typeofbsn'] ?> one description</h5>
                        <p class="card-text"><?= $user['proddesc'] ?></p>
                        <small>last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <img class="card-img-top" src="<?= $user['produrltwo'] ?>" alt="Card image cap">
                    <div class="card-body bg-dark text-white">
                        <h5 class="card-title"><?= $user['typeofbsn'] ?> two description</h5>
                        <p class="card-text"><?= $user['proddesctwo'] ?></p>
                        <small>last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <img class="card-img-top" src="<?= $user['produrlthree'] ?>" alt="Card image cap">
                    <div class="card-body bg-dark text-white">
                        <h5 class="card-title"><?= $user['typeofbsn'] ?> three description</h5>
                        <p class="card-text"><?= $user['proddescthree'] ?></p>
                        <small>last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="contact" class="container my-3">
        <hr>
        <div class="row">
            <div class="col-6">
                <h3 class="text-left">Contact</h3>
                <p><?= $user['compdesc'] ?></p>
            </div>
            <div class="col-6">
                <form>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control">
                        <label for="mail">Email</label>
                        <input type="email" class="form-control">
                        <label for="msg">Message</label>
                        <textarea name="msg" id="msg" cols="30" rows="5" class="form-control"></textarea>
                        <div class="text-center mt-3">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="footer bg-dark p-2 text-center">
        <small class="d-block text-center text-white">Copyright @ Brainster</small>
        <a href="<?= $user['linkedin'] ?>" class="text-decoration-none text-white"><i class="fa-brands fa-linkedin-in fa-2x"></i></a>
        <a href="<?= $user['twitter'] ?>" class="text-decoration-none text-white"><i class="fa-brands fa-twitter fa-2x"></i></a>
        <a href="<?= $user['facebook'] ?>" class="text-decoration-none text-white"><i class="fa-brands fa-facebook-f fa-2x"></i></a>
        <a href="<?= $user['instagram'] ?>" class="text-decoration-none text-white"><i class="fa-brands fa-instagram fa-2x"></i></a>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>