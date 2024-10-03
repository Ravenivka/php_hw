<?php 

//Для целых чисел
function power($val, $pow) {
    $result = 1;
    if ($pow == 0) {
        return 1;
    } else if ($pow < 0) {
        return power($val,$pow + 1) / $val;
    } else {
        return power($val, $pow - 1) * $val;
    }
}

var_dump(power(2,-3));

