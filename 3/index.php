<?php

require_once __DIR__ . "/classes/Furniture.php";
require_once __DIR__ . "/classes/Sofa.php";
require_once __DIR__ . "/classes/Bench.php";
require_once __DIR__ . "/classes/Chair.php";



$s1 = new Sofa(250, 40, 50);

$s1->setSeats(4);
$s1->setArmrests(2);
$s1->setIsForSleeping(1);
$s1->setIsForSeating(0);
$s1->setLengthOpened(80);

$s1->print();
$s1->sneakpeek();
$s1->fullinfo();

echo "<hr/>";

$s2 = new Bench(160, 61, 88);

$s2->setSeats(4);
$s2->setArmrests(2);
$s2->setIsForSeating(1);
$s2->setIsForSleeping(0);

$s2->print();
$s2->sneakpeek();
$s2->fullinfo();

echo "<hr/>";

$s3 = new Chair(46, 48, 101);

$s2->setSeats(1);
$s2->setArmrests(2);
$s2->setIsForSeating(1);
$s2->setIsForSleeping(0);

$s3->print();
$s3->sneakpeek();
$s3->fullinfo();

echo "<hr/>";