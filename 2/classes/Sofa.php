<?php

require_once __DIR__ . "/Furniture.php";

class Sofa extends Furniture {
    private $seats;
    private $armrests;
    private $length_opened;

    public function getSeats()
    {
        return $this->seats;
    }

    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    public function getArmrests()
    {
        return $this->armrests;
    }

    public function setArmrests($armrests)
    {
        $this->armrests = $armrests;

        return $this;
    }

    public function getLengthOpened()
    {
        return $this->length_opened;
    }

    public function setLengthOpened($length_opened)
    {
        $this->length_opened = $length_opened;

        return $this;
    }

    public function area_opened() {
        if ($this->getIsForSleeping() == 1) {
            echo "This sofa is for sitting and sleeping, it has {$this->getArmrests()} armrests, {$this->getSeats()} seats and area:";
            echo $this->getWidth() * $this->getLengthOpened();
            echo "cm3 when opened.<br/>";
        }

        else echo "This sofa is for sitting only, it has {$this->getArmrests()} armrests and {$this->getSeats()} seats.<br/>";
    }
}