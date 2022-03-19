<?php

class Product
{
    private $name;
    private $price;
    private $sellingByKg;

    public function __construct($name, $price, $sellingByKg)
    {
        $this->name = $name;
        $this->price = $price;
        $this->sellingByKg = $sellingByKg;
    }

    public function returnPrice()
    {
        if (!is_bool($this->sellingByKg)) {
            echo "Error: sellingByKg not defined.";
        } else if ($this->sellingByKg == true)
            echo "$this->name costs $this->price$ per kg.<br/>";
        else if ($this->sellingByKg == false) {
            echo "$this->name costs $this->price$ per gunny sack.<br/>";
        }
    }
}

$p1 = new Product("orange", 35, true);
$p2 = new Product("apple", 30, false);
$p3 = new Product("rice", 35, 35);

$p1->returnPrice();
$p2->returnPrice();
$p3->returnPrice();
