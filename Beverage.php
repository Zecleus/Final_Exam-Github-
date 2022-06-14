<?php

class Beverage implements IConsumable{

    protected string $name;
    protected float $price;
    protected string $size;
    protected int $qty;

    public function __construct($name, $price, $size, $qty)
    {
        $this->name = $name;
        $this->price = $price;
        $this->size = $size;
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
    public function totalPrice()
    {
        return $this->price*$this->qty;
    }

}
?>