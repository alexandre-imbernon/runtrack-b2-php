<?php
function my_array_sort(array $arrayToSort, string $order) : array {

    if ($order === 'ASC') {
        sort($arrayToSort);
    } elseif ($order === 'DESC') {
        rsort($arrayToSort);
    }

    return $arrayToSort;
}

var_dump(my_array_sort([2, 24, 12, 7, 34], 'ASC'));  
var_dump(my_array_sort([8, 5, 23, 89, 6, 10], 'DESC')); 
?>
