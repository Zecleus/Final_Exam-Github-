<?php

class Tea extends Beverage{
    protected bool $temp;

    public function __construct($name, $price,  $size, $temp, $qty)
    {
        parent::__construct($name, $price, $size, $qty);
        $this->temp = $temp;
    }

    public function setTemp($temp)
    {
        $this->temp = $temp;
    }

    public function getTemp(): bool{
        return $this->temp;
    }
}