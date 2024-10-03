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
//var_dump(replacer("ё", $dict));

$str = "в лесу родилась ёлочка";


function recoder($str, $dict) {
    $arr = preg_split('//u', $str, 0, PREG_SPLIT_NO_EMPTY);
    $n = count($arr);
    $output = "";
    for ($i = 0; $i < $n; $i++) {
        $output = $output.replacer($arr[$i],$dict);
    }
    return $output;
}
echo recoder($str, $dict);
