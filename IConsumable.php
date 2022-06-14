<?php

interface IConsumable{

    public function getName();
    public function setName($name);

    public function getPrice();
    public function setPrice($newPrice);

    public function totalPrice();

}
?>