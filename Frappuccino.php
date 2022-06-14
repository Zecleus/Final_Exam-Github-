<?php

class Frappuccino extends Beverage{
    
    public function __construct($name, $price,  $size, $qty)
    {
        parent::__construct($name, $price, $size, $qty);
    }
}