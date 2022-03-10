<?php

require_once __DIR__ . "/../interfaces/Printable.php";

abstract class Furniture implements Printable {
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

    public function getWidth()
    {
        return $this->width;
    }

    public function getLength() {
        return $this->length;
    }

    public function getHeight() {
        return $this->height;
    }

    public function area() {
        return $this->width * $this->length / 10;
    }

    public function volume() {
        return $this->area() * $this->height;
    }

    public function print() {
        echo get_class($this);
        echo ", area: {$this->area()}cm2<br/>";
    }

    public function sneakpeek() {
        echo get_class($this);
        echo "<br/>";
    }

    public function fullinfo() {
        echo get_class($this);
        echo ", area: {$this->area()}cm2, width: {$this->width}cm, length: {$this->length}cm, height: {$this->height}cm<br/>";
    }
}