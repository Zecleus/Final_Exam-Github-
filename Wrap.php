<?php

class Wrap extends Food{
    protected int $sirachaQty;

    public function __construct($name, $price, $boughtState)
    {
        parent::__construct($name, $price, $boughtState);
        $this->sirachaQty = 1;
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