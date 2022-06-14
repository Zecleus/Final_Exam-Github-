<?php

class Wrap extends Food{
    protected int $sirachaQty;

    public function __construct($name, $price, $sirachaQty, $qty)
    {
        parent::__construct($name, $price, $qty);
        $this->sirachaQty = $sirachaQty;
    }

    public function getSirachaQty(){
        return $this->sirachaQty;
    }

    //I think no need na kay naa na sa js ang pag add ug minus
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