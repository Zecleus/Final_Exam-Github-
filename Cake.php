<?php

class Cake extends Food{

    protected bool $warm;

    public function __construct($name, $price, $warm)
    {
        parent::__construct($name, $price);
        $this->warm = $warm;
    }

    public function toggleWarm(){
        $this->warm = !$this->warm;
    }

    public function getWarm(): bool{
        return $this->warm;
    }

}