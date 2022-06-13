<?php

class Coffee extends Beverage{
    protected bool $temp;

    public function __construct($name, $price, $boughtState, $size, $temp)
    {
        parent::__construct($name, $price, $boughtState, $size);
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