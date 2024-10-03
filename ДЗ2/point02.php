<?php  
require_once ('point01.php');
function mathOperation($arg1, $arg2, $operation) {
    switch ($operation) {
        case '+':
            return amount($arg1, $arg2); // break не нужен
        case '-':
            return difference($arg1, $arg2);
        case '/':
            return quotient($arg1, $arg2);
        case '*':
            return multiplication($arg1, $arg2);
        default:
            return 'Неизвестная операция';
    }
}

var_dump(mathOperation(10,5,'*'));