<?php

class Beverage implements IConsumable{

    protected string $name;
    protected float $price;
    protected bool $boughtState;
    protected string $size;

    public function __construct($name, $price, $boughtState, $size)
    {
        $this->name = $name;
        $this->price = $price;
        $this->boughtState = $boughtState;
        $this->size = $size;
    }


    public function toggleBoughtState(){
        $this->boughtState = !$this->boughtState;
    }

    public function getPrice(): float{
        return $this->price;
    }
    public function setPrice($newPrice){
        $this->price = $newPrice;
    }
}
?>