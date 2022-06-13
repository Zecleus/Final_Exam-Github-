<?php

class Frappuccino extends Beverage{
    
    public function __construct($name, $price, $boughtState, $size)
    {
        parent::__construct($name, $price, $boughtState, $size);
    }
}