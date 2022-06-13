<?php

class Food implements IConsumable{


    protected string $name;
    protected float $price;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): float{
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }


    public function getPrice(): float{
        return $this->price;
    }
    public function setPrice($newPrice){
        $this->price = $newPrice;
    }
}
?>