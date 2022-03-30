<?php

require_once __DIR__ . "/./database/connection.php";

$sqlAllProd = "SELECT * FROM `typeofbusiness` WHERE 1";
$stmtAllProd = $pdo->query($sqlAllProd);

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <style>
        * {
            box-sizing: border-box;
        }

        .bg {
            min-height: 100%;
            background: url("./img/laptop.jpg"), rgba(0, 0, 0, 0);
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="bg vh-100">
        <div class="container">
            <h2 class="text-center mb-4">You are one step away from your webpage</h2>
            <form action="./store.php" method="POST">
                <div class="form-group d-flex">
                    <div class="col-4 bg-white p-3 mr-3">
                        <label class="m-0" for="coverurl">Cover Image URL</label>
                        <input class="form-control mb-2" type="text" name="coverurl" id="coverurl" required>
                        <label class="m-0" for="maintitle">Main Title of Page</label>
                        <input class="form-control mb-2" type="text" name="maintitle" id="maintitle" required>
                        <label class="m-0" for="subtitle">Subtitle of Page</label>
                        <input class="form-control mb-2" type="text" name="subtitle" id="subtitle" required>
                        <label class="m-0" for="bio">Something about you</label>
                        <textarea class="form-control mb-2" name="bio" id="bio" cols="30" rows="2" required></textarea>
                        <label class="m-0" for="telnumber">Your telephone number</label>
                        <input class="form-control mb-2" type="tel" name="telnumber" id="telnumber" required>
                        <label class="m-0" for="location">Your location</label>
                        <input class="form-control mb-2" type="text" name="location" id="location" required>
                        <label class="m-0" for="typeofbsn">Do you provide services or products?</label>
                        <select class="form-control" name="typeofbsn" id="typeofbsn">
                            <?php while ($prod = $stmtAllProd->fetch()) { ?>
                                <option value="<?= $prod['id'] ?>"><?= $prod['type'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-4 bg-white p-3 mr-3">
                        <p>Provide url for an image and description of your service/product</p>
                        <label class="m-0" for="produrl">Image URL</label>
                        <input class="form-control mb-2" type="text" name="produrl" id="produrl" required>
                        <label class="m-0" for="proddesc">Description of service/product</label>
                        <textarea class="form-control mb-2" name="proddesc" id="proddesc" cols="30" rows="2" required></textarea>
                        <label class="m-0" for="produrltwo">Second image URL</label>
                        <input class="form-control mb-2" type="text" name="produrltwo" id="produrltwo" required>
                        <label class="m-0" for="proddesctwo">Second description of service/product</label>
                        <textarea class="form-control mb-2" name="proddesctwo" id="proddesctwo" cols="30" rows="2" required></textarea>
                        <label class="m-0" for="produrlthree">Third image URL</label>
                        <input class="form-control mb-2" type="text" name="produrlthree" id="produrlthree" required>
                        <label class="m-0" for="proddescthree">Third description of service/product</label>
                        <textarea class="form-control mb-2" name="proddescthree" id="proddescthree" cols="30" rows="2" required></textarea>
                    </div>
                    <div class="col-4 bg-white p-3">
                        <label class="m-0" for="compdesc">Provide a description of your company, something people should be aware of before they contact you:</label>
                        <textarea class="form-control mb-4" name="compdesc" id="compdesc" cols="30" rows="2" required></textarea>
                        <hr>
                        <label class="m-0" for="linkedin">Linkedin:</label>
                        <input class="form-control mb-2" type="text" name="linkedin" id="linkedin" required>
                        <label class="m-0" for="facebook">Facebook:</label>
                        <input class="form-control mb-2" type="text" name="facebook" id="facebook" required>
                        <label class="m-0" for="twitter">Twitter:</label>
                        <input class="form-control mb-2" type="text" name="twitter" id="twitter" required>
                        <label class="m-0" for="instagram">Instagram:</label>
                        <input class="form-control mb-2" type="text" name="instagram" id="instagram" required>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn-lg btn-secondary btn-block text-center border-0" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>