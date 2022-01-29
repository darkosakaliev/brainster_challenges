<?php
date_default_timezone_set('Europe/Skopje');
// $today = 15;  //for testing purposes
$today = date("H");

$voter = ['Peter' => 'false,5', 'Kathrin' => 'true,3', 'Joe' => 'false,12', 'Marilyn' => 'true,4', 'Jimbo' => 'false,9', 'Mark' => 'false,d', 'Alex' => 'true,1', 'Ethan' => 'true,8', 'Jessica' => 'false,11', 'Cassie' => 'true,5'];

foreach ($voter as $name => $voting) {
    $voting = explode(',', $voting);
    
    if ($today <= 12) {
        echo "<h1>Good morning $name,</h1>";
    } else if ($today > 12 && $today <= 19) {
        echo "<h1>Good afternoon $name,</h1>";
    } else if ($today > 19) {
        echo "<h1>Good evening $name,</h1>";
    }

    if ($voting[0] == 'true' && ($voting[1] >= 1 && $voting[1] <= 10 && is_numeric($voting[1]))) {
        echo "<h2>You already voted with a $voting[1].</h2>";
    } else if ($voting[0] == 'false' && ($voting[1] >= 1 && $voting[1] <= 10 && is_numeric($voting[1]))) {
        echo "<h2>Thank you for voting with a $voting[1].</h2>";
    } else {
        echo "<h2>Invalid rating, only numbers between 1 and 10.</h2>";
    }
}
