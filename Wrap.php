<?php

class Wrap extends Food{
    protected int $sirachaQty;

    public function __construct($name, $price, $sirachaQty)
    {
        parent::__construct($name, $price);
        $this->sirachaQty = $sirachaQty;
    }

    public function getSirachaQty(){
        return $this->sirachaQty;
    }

    public function addSiracha(){
        $this->sirachaQty++;
    }

    public function removeSiracha(){
        if($this->sirachaQty > 2){
            $this->sirachaQty--;
        }else{
            echo "Have at least 1 siracha sauce.";
        }
    }
}