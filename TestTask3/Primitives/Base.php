<?php

class Base
{
    public $name;
    public $area;
    public $a;
    public $b;
    public $c;
    public $radius;

    public function __construct($fig)
    {
        foreach ($fig as $key=>$value){
            $this->{$key}=$value;
            $this->findArea();
        }
    }

    public function __toString()
    {
        return  sprintf('Figname: %s. Area: %03.2f<br>', $this->name, $this->area);
    }

    public function findArea(){
        return;
    }
}