<?php

class Rectangle extends Base
{
    public $name = 'rectangle';
    public function findArea()
    {
        $this->area = $this->a *$this->b;
    }
}