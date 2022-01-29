<?php
date_default_timezone_set('Europe/Skopje');

$name = "Kathrin";
$rating = 5;
// $today = 15;  //for testing purposes
$today = date("H");
$rated = true;


if ($name == "Kathrin" && $today <= 12) {
    echo "<h1>Good morning Kathrin</h1>";
} else if ($name == "Kathrin" && ($today > 12 && $today <= 19)) {
    echo "<h1>Good afternoon Kathrin</h1>";
} else if ($name == "Kathrin" && $today > 19) {
    echo "<h1>Good evening Kathrin</h1>";
} else {
    echo "<h1>Nice name</h1>";
}

if ($rating >= 1 && $rating <= 10 && is_int($rating)) {
    echo "<h2>Thank you for rating.</h2>";
    if ($rated) {
        echo "<h2>You already voted.</h2>";
    } else {
        echo "<h2>Thanks for voting.</h2>";
    }
} else {
    echo "<h2>Invalid rating, only numbers between 1 and 10.</h2>";
}
