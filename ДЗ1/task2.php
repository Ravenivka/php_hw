<?php

$a = 3;
$b = 2;
$a = $a + $b - ($b = $a);
var_dump ($a);
var_dump ($b);
