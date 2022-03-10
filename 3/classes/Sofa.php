<?php

class Sofa extends Furniture implements Printable {
    private $seats;
    private $armrests;
    private $length_opened;

    public function __construct($width, $length, $height) {
        parent::__construct($width, $length, $height);
    }

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
                return "area_opened: " . $this->getWidth() * $this->getLengthOpened() / 10 . "cm2,";
            }
    
            else if ($this->getIsForSeating() == 1) {
                echo ", sitting only";
            }
        }

        public function print() {
            echo get_class($this);
            echo ", {$this->area_opened()} area: {$this->area()}cm2<br/>";
        }

        public function fullinfo() {
            echo get_class($this);
            echo ", {$this->area_opened()} area: {$this->area()}cm2, width: {$this->getWidth()}cm, length: {$this->getLength()}cm, height: {$this->getHeight()}cm<br/>";
        }
}