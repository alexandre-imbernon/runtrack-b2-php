<?php
function my_is_prime(int $number) : bool {
    if ($number < 2) {
        return false;
    }

    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i === 0) {
            return false; 
        }
    }

    return true; 
}
var_dump(my_is_prime(3)); 
var_dump(my_is_prime(12)); 
?>