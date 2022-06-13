<?php

class Frappuccino extends Beverage{
    
    public function __construct($name, $price,  $size)
    {
        parent::__construct($name, $price, $size);
    }
}