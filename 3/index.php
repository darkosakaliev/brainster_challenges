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

    public function getSellingByKg()
    {
        return $this->sellingByKg;
    }

    public function getPrice()
    {
        return $this->price;
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
            $arr = get_object_vars($this->prodStore[$name]);
            $price = $arr['price'] * $amount;
            if ($arr['sellingByKg'] == true) {
                return ['item' => $name, 'amount' => "{$amount}kgs", $price];
            } else if ($arr['sellingByKg'] == false) {
                return ['item' => $name, 'amount' => "{$amount} gunny sacks", $price];
            }
        } else {
            echo "Product doesn't exist.";
        }
    }
}

class Cart
{
    private $cartItems = [];

    public function AddToCart($cartItems)
    {
        array_push($this->cartItems, $cartItems);
    }

    public function printReceipt()
    {
        if (empty($this->cartItems)) {
            echo "Your cart is empty.";
        } else {
            $sum = 0;
            foreach ($this->cartItems as $value) {
                echo "{$value['item']} | {$value['amount']} | total = {$value[0]} denars<br/>";
                $sum += $value[0];
            }
            echo "<br/>Final price amount: $sum denars";
        }
    }
}

$orange = new Product("Orange", 35, true);
$potato = new Product("Potato", 240, false);
$nuts = new Product("Nuts", 850, true);
$kiwi = new Product("Kiwi", 670, false);
$pepper = new Product("Pepper", 330, true);
$raspberry = new Product("Raspberry", 555, false);

$m1 = new MarketStall(['Orange' => $orange, 'Potato' => $potato]);
$m1->addProductToMarket($nuts);

$m2 = new MarketStall(['Kiwi' => $kiwi]);
$m2->addProductToMarket($pepper);
$m2->addProductToMarket($raspberry);

$c1 = new Cart();
$c1->AddToCart($m1->getItem('Orange', 3));
$c1->AddToCart($m2->getItem('Pepper', 4));
$c1->AddToCart($m1->getItem('Nuts', 2));
$c1->AddToCart($m2->getItem('Kiwi', 1));
$c1->AddToCart($m1->getItem('Potato', 2));
$c1->AddToCart($m2->getItem('Raspberry', 4));
$c1->printReceipt();
