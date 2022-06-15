<?php

class Food implements IConsumable{


    protected string $name;
    protected float $price;
    protected int $qty;

    public function __construct($name, $price, $qty)
    {
        $this->name = $name;
        $this->price = $price;
        $this->qty = $qty;
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

    public function getTotalPrice()
    {
        return $this->price*$this->qty;
    }
}
?>