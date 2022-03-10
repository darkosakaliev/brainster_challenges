<?php

require_once __DIR__ . "/classes/Furniture.php";

$f1 = new Furniture(250, 40, 50);

$f1->area();
$f1->volume();
$f1->setIsForSeating(1);
$f1->setIsForSleeping(0);

$f1->print();