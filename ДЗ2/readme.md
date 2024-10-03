# Урок 2. Условия, Массивы, циклы, функции #

*Реализовать основные 4 арифметические операции*

```
<?php 
function amount ($arg1, $arg2) {
    $arg3 = $arg1 + $arg2;
    return $arg3;
}

function difference ($arg1, $arg2) {
    $arg3 = $arg1 - $arg2;
    return $arg3;
}

function quotient ($arg1, $arg2) {
    $arg3 = $arg1 / $arg2;
    return $arg3;
}

function multiplication ($arg1, $arg2) {
    $arg3 = $arg1 * $arg2;
    return $arg3;
}
```
Решение [тут](point01.php)

*Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции. В зависимости от переданного значения операции выполнить одну из арифметических операций (использовать функции из пункта 3) и вернуть полученное значение (использовать switch)*
```
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
```
Решение [тут](point02.php)

*Объявить массив, в котором в качестве ключей будут использоваться названия областей, а в качестве значений – массивы с названиями городов из соответствующей области. Вывести в цикле значения массива, чтобы результат был таким: Московская область: Москва, Зеленоград, Клин Ленинградская область: Санкт-Петербург, Всеволожск, Павловск, Кронштадт Рязанская область … (названия городов можно найти на maps.yandex.ru)*
```
<?php 

$Cities = array (
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
    'Свердловская область' => ['Екатеринбург', 'Ревда', 'Первоуральск', 'Серов', 'Реж']
);
foreach($Cities as $key => $towns) {
    echo $key.': ';
    foreach($towns as $town) {
        echo $town.', ';
    }

}
```
Решение [тут](point03.php)

*Объявить массив, индексами которого являются буквы русского языка, а значениями – соответствующие латинские буквосочетания (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’). Написать функцию транслитерации строк*
```
<?php 

$dict = array (
"а" => "a",
"б" => "b",
"в" => "v",
"г" => "g",
"д" => "d",
"е" => "e",
"ж" => "zh",
"з" => "z",
"и" => "i",
"й" => "iy",
"к" => "k",
"л" => "l",
"м" => "m",
"н" => "n",
"о" => "o",
"п" => "p",
"р" => "r",
"с" => "s",
"т" => "t",
"у" => "u",
"ф" => "f",
"х" => "h",
"ц" => "c",
"ч" => "ch",
"ш" => "sh",
"щ" => "tsh",
"ъ" => "'",
"ы" => "y",
"ь" => "'",
"э" => "e",
"ю" => "yu",
"я" => "ya",
"ё" => "yo"
);
// Без заглавных букв (надо расширять словарь)
function replacer ($char, $arr) :string {    
    if (array_key_exists($char, $arr)) {
        return $arr[$char];
    }
    return $char;
}
function recoder($str, $dict) {
    $arr = preg_split('//u', $str, 0, PREG_SPLIT_NO_EMPTY);
    $n = count($arr);
    $output = "";
    for ($i = 0; $i < $n; $i++) {
        $output = $output.replacer($arr[$i],$dict);
    }
    return $output;
}

```
Решение [тут](point04.php)

*С помощью рекурсии организовать функцию возведения числа в степень. Формат: function power($val, $pow), где $val – заданное число, $pow – степень*
```
<?php 

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
```
Решение [тут](point05.php)


