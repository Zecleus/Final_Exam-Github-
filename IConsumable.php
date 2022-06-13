<?php

interface IConsumable{
    public function toggleBoughtState();

    public function getPrice();
    public function setPrice($newPrice);


}
?>