<?php
function my_closest_to_zero(array $array) : int {
    return array_reduce($array, function($closest, $number) {
        return abs($number) < abs($closest) || (abs($number) === abs($closest) && $number < $closest) ? $number : $closest;
    }, $array[0]);
}

var_dump(my_closest_to_zero([2, -1, 5, 23, 21, 9])); 
var_dump(my_closest_to_zero([234, -142, 512, 1223, 451, -59])); 
?>
