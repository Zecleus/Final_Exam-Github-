<?php

require_once 'init2.php';

use Sessions\Session;

class OrderList{

    public function addOrderWrap(string $name, float $price, $sirachaQty){
        $wrapItem = new Wrap($name, $price, $sirachaQty);

        $additional = $sirachaQty * 5;
        
        $wrapItem->setPrice($price+$additional);

        if(!Session::has('orderList')){
            $_SESSION['orderList'][0] = $wrapItem;
        }
        else{
            $temp = Session::get('orderList');
            array_push($temp, $wrapItem);
            Session::add('orderList', $temp);
        }
    }

    public function addOatmeal(string $name, float $price){
        $oatmealItem= new Oatmeal($name, $price);

        if(!Session::has('orderList')){
            $_SESSION['orderList'][0] = $oatmealItem;
        }
        else{
            $temp = Session::get('orderList');
            array_push($temp, $oatmealItem);
            Session::add('orderList', $temp);
        }
    }

    public function addCake(string $name, float $price, $warm){
        $cakeItem = new Cake($name, $price, $warm);

        if(!Session::has('orderList')){
            $_SESSION['orderList'][0] = $cakeItem;
        }
        else{
            $temp = Session::get('orderList');
            array_push($temp, $cakeItem);
            Session::add('orderList', $temp);
        }
    }

    public function addCoffee(string $name, float $price, $size, $temp){
        if($size == 1){
            $additional = 0;
        }
        else if($size == 2){
            $additional = 50;
        }
        else if($size == 2){
            $additional = 90;
        }

        $coffeeItem = new Coffee($name, $price+$additional, $size, $temp);

        if(!Session::has('orderList')){
            $_SESSION['orderList'][0] = $coffeeItem;
        }
        else{
            $temp = Session::get('orderList');
            array_push($temp, $coffeeItem);
            Session::add('orderList', $temp);
        }
    }

    public function addTea(string $name, float $price, $size, $temp){
        if($size == 1){
            $additional = 0;
        }
        else if($size == 2){
            $additional = 50;
        }
        else if($size == 2){
            $additional = 90;
        }

        $teaItem = new Tea($name, $price+$additional, $size, $temp);

        if(!Session::has('orderList')){
            $_SESSION['orderList'][0] = $teaItem;
        }
        else{
            $temp = Session::get('orderList');
            array_push($temp, $teaItem);
            Session::add('orderList', $temp);
        }
        
    }
    
    public function addFrappuccino(string $name, float $price, $size){

        if($size == 1){
            $additional = 0;
        }
        else if($size == 2){
            $additional = 50;
        }
        else if($size == 2){
            $additional = 90;
        }

        $frappuccinoItem = new Frappuccino($name, $price+$additional, $size);

        if(!Session::has('orderList')){
            $_SESSION['orderList'][0] = $frappuccinoItem;
        }
        else{
            $temp = Session::get('orderList');
            array_push($temp, $frappuccinoItem);
            Session::add('orderList', $temp);
        }
    }

    public function cancelItem(int $position){
        Session::removeSpecificElement('orderList', $position);
    }
}