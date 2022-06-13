<?php

class Food implements IConsumable{


    protected string $name;
    protected float $price;
    protected bool $boughtState;

    public function __construct($name, $price, $boughtState)
    {
        $this->name = $name;
        $this->price = $price;
        $this->boughtState = $boughtState;
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