<?php

class Cake extends Food{

    protected bool $warm;

    public function __construct($name, $price, $boughtState, $warm)
    {
        parent::__construct($name, $price, $boughtState);
        $this->warm = $warm;
    }

    public function toggleWarm(){
        $this->warm = !$this->warm;
    }

    public function getWarm(): bool{
        return $this->warm;
    }

}