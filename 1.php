<?php

$name = "Mark";
$rating = 5;

if ($name == "Kathrin") {
    echo "<h1>Hello Kathrin</h1>";
} else {
    echo "<h1>Nice name</h1>";
}

if ($rating >= 1 && $rating <= 10) {
    echo "<h2>Thank you for rating.</h2>";
} else {
    echo "<h2>Invalid rating, only numbers between 1 and 10.</h2>";
}
