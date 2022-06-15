<?php

class Cake extends Food{

    protected string $warm;

    public function __construct($name, $price, $warm,$qty)
    {
        parent::__construct($name, $price, $qty);
        $this->warm = $warm;
    }

    public function toggleWarm(){
        $this->warm = !$this->warm;
    }

    public function getWarm(): bool{
        return $this->warm;
    }

}