<?php

class Circle extends Base
{
    public $name = 'circle';
    public function findArea(){
        $this->area = M_PI * $this->radius**2;
    }
}