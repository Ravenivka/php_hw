<?php

//Поиск по файлу.
function search_bd ($path) {
    $file = fopen($path, 'r') or die("не удалось открыть файл");
    $array = array();
    while(!feof($file)) {
        $str = fgets($file); 
        $pieces = explode(",", $str);        
        $today = (new DateTime()) -> format('d.m.Y');   // а в функции addFunction ДД-ММ-ГГГГ - непорядок аднака
        $day1 = (new DateTime($pieces[1])) -> format('d.m.Y');
        if ($day1 == $today) {
            array_push($array, $pieces[0]);
        }
      }
    fclose($path);
    return $array;  
}

function getBirthday_boy (array $config) {
    $address = $config['storage']['address'];
    $array = search_bd ($address);
    if (sizeof($array) == 0) {
        return "Сегодня именинников нет";
    }
    $str = "Именинники: ". PHP_EOL;
    foreach($array as $str1) {
        $str = $str.$str1. PHP_EOL;
    } 
    return $str;
}

//Удаление строки. 
function search_by ($path, $pattern) {
    $file = fopen($path, 'r') or die("не удалось открыть файл");
    $n = 0;       
    while(!feof($file)) {
        $str = fgets($file);
        if (strpos($str, $pattern) == true) { 
            fclose($path);           
            return $n;
        }
        $n++;
    }
    fclose($path);
    return -1;
}

function removeLine (array $config) : string {
    $address = $config['storage']['address'];
    $pattern = readline("Введите имя или дату рождения в формате ДД-ММ-ГГГГ: ");
    $lineNumber = search_by ($address, $pattern);
    if ($lineNumber == -1) {
        return "Совпадений не обнаружено";
    }
    $file = fopen($address, 'r') or die("не удалось открыть файл");
    $aim = '';
    $n = 0;
    while(!feof($file)) {
        $str = fgets($file);
        if ($n == $lineNumber) {
            $aim = $str;
            break;
        }
    }
    fclose($file);
    if ($aim == ''){
        return "Ошибка поиска";
    }
    echo "Вы действительно хотите удалить строку: ".$aim."? (Y/N)";
    $decision = readline();
    if ($decision == 'Y') {
        $tmpname = tempnam(__DIR__, 'tmp');
        $temp = fopen( $tmpname, 'a');
        $file = fopen($address, 'r');
        while(!feof($file)) {
            $str = fgets($file);
            if ($n != $lineNumber) {
                fwrite($temp, $str.PHP_EOL); 
            }
        }
        fclose($file);
        fclose($temp);
        if (copy($tmpname, $address)){
            echo "Копия файла создана";
        }
        else   { 
            echo "Ошибка копирования файла";
        }
        unlink($tmpname);

    } else {
        return "Действие отменено";
    }

}







// function readAllFunction(string $address) : string {
function readAllFunction(array $config) : string {
    $address = $config['storage']['address'];

    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "rb");
        
        $contents = ''; 
    
        while (!feof($file)) {
            $contents .= fread($file, 100);
        }
        
        fclose($file);
        return $contents;
    }
    else {
        return handleError("Файл не существует");
    }
}

// function addFunction(string $address) : string {
function addFunction(array $config) : string {
    $address = $config['storage']['address'];

    $name = readline("Введите имя: ");
    $date = readline("Введите дату рождения в формате ДД-ММ-ГГГГ: ");
    $data = $name . ", " . $date . "\r\n";

    $fileHandler = fopen($address, 'a');

    if(fwrite($fileHandler, $data)){
        return "Запись $data добавлена в файл $address"; 
    }
    else {
        return handleError("Произошла ошибка записи. Данные не сохранены");
    }

    fclose($fileHandler);
}

// function clearFunction(string $address) : string {
function clearFunction(array $config) : string {
    $address = $config['storage']['address'];

    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "w");
        
        fwrite($file, '');
        
        fclose($file);
        return "Файл очищен";
    }
    else {
        return handleError("Файл не существует");
    }
}

function helpFunction() {
    return handleHelp();
}

function readConfig(string $configAddress): array|false{
    return parse_ini_file($configAddress, true);
}

function readProfilesDirectory(array $config): string {
    $profilesDirectoryAddress = $config['profiles']['address'];

    if(!is_dir($profilesDirectoryAddress)){
        mkdir($profilesDirectoryAddress);
    }

    $files = scandir($profilesDirectoryAddress);

    $result = "";

    if(count($files) > 2){
        foreach($files as $file){
            if(in_array($file, ['.', '..']))
                continue;
            
            $result .= $file . "\r\n";
        }
    }
    else {
        $result .= "Директория пуста \r\n";
    }

    return $result;
}

function readProfile(array $config): string {
    $profilesDirectoryAddress = $config['profiles']['address'];

    if(!isset($_SERVER['argv'][2])){
        return handleError("Не указан файл профиля");
    }

    $profileFileName = $profilesDirectoryAddress . $_SERVER['argv'][2] . ".json";

    if(!file_exists($profileFileName)){
        return handleError("Файл $profileFileName не существует");
    }

    $contentJson = file_get_contents($profileFileName);
    $contentArray = json_decode($contentJson, true);

    $info = "Имя: " . $contentArray['name'] . "\r\n";
    $info .= "Фамилия: " . $contentArray['lastname'] . "\r\n";

    return $info;
}