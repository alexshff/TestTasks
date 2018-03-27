<?php

define("LIMIT", 2000000);

$range = array_fill_keys ( range(3, LIMIT, 2) , true );

for($i=3;$i**2 <= LIMIT;$i++)
{
    if (isset($range[$i]) and $range[$i]){
        for($j=$i**2; $j <= LIMIT;$j=$j+$i){
            $range[$j] = false;
        }
    }
}

$sum = array_sum(array_keys(array_filter($range))) + 2;
echo "Sum of all prime numbers below " . LIMIT . " is {$sum}.";