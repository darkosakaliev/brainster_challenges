<?php

require_once __DIR__ . "/classes/Furniture.php";
require_once __DIR__ . "/classes/Sofa.php";


$s1 = new Sofa(250, 40, 50);
$s1->setIsForSeating(1);
$s1->setArmrests(2);
$s1->setSeats(4);
$s1->area();
$s1->volume();
$s1->area_opened();
$s1->setIsForSleeping(1);
$s1->setLengthOpened(80);
$s1->area_opened();