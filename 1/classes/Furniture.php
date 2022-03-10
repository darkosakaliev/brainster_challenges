<?php

class Furniture {
    private $width;
    private $length;
    private $height;
    private $is_for_seating;
    private $is_for_sleeping;

    public function __construct($width, $length, $height) {
        $this->width = $width;
        $this->length = $length;
        $this->height = $height;
    }
    
    public function getIsForSleeping()
    {
        return $this->is_for_sleeping;
    }

    public function setIsForSleeping($is_for_sleeping)
    {
        $this->is_for_sleeping = $is_for_sleeping;

        return $this;
    }

    public function getIsForSeating()
    {
        return $this->is_for_seating;
    }

    public function setIsForSeating($is_for_seating)
    {
        $this->is_for_seating = $is_for_seating;

        return $this;
    }

    public function area() {
        return ($this->width * $this->length);
    }

    public function volume() {
        return $this->area() * $this->height;
    }

    public function print() {
        echo "width: {$this->width}cm, length: {$this->length}cm, height: {$this->height}cm, is_for_seating: {$this->getIsForSeating()}, is_for_sleeping: {$this->getIsForSleeping()}, area: {$this->area()}cm2, volume: {$this->volume()}cm3";
    }
}