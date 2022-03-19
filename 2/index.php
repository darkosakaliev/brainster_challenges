<?php

class Product
{
    public $name;
    public $price;
    public $sellingByKg;

    public function __construct($name, $price, $sellingByKg)
    {
        $this->name = $name;
        $this->price = $price;
        $this->sellingByKg = $sellingByKg;
    }

    public function returnPrice()
    {
        if (!is_bool($this->sellingByKg)) {
            echo "Error: sellingByKg not defined.<br/>";
        } else if ($this->sellingByKg == true)
            echo "$this->name costs $this->price$ per kg.<br/>";
        else if ($this->sellingByKg == false) {
            echo "$this->name costs $this->price$ per gunny sack.<br/>";
        }
    }

    public function getName()
    {
        return $this->name;
    }
}

class MarketStall
{
    public $prodStore;

    public function __construct($prodStore)
    {
            $this->prodStore = $prodStore;
    }

    public function addProductToMarket($value)
    {
        $this->prodStore[$value->getName()] = $value;
    }

    public function getItem($name, $amount)
    {
        if (array_key_exists($name, $this->prodStore)) {
            return $arr = ['amount' => $amount, 'item' => $name];
        } else {
            echo "Product doesn't exist.";
        }
    }
}

$orange = new Product("orange", 35, true);
$apple = new Product("apple", 30, false);
$raspberry = new Product("raspberry", 50, true);
$rice = new Product("rice", 20, true);

$m1 = new MarketStall(['orange' => $orange, 'apple' => $apple]);
$m1->addProductToMarket($raspberry);
$m1->addProductToMarket($rice);
$m1->getItem('orange', 4);
$m1->getItem('raspberry', 4);
echo "<pre>";
print_r($m1);