<?php

class Triangle extends Base
{
    public $name = 'triangle';
    public function findArea()
    {
        $p = 0.5 * ($this->a + $this->b + $this->c);
        $this->area = sqrt($p*($p-$this->a)*($p-$this->b)*($p-$this->c));
    }
}