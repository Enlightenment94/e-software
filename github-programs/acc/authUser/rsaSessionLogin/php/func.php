<?php

function generateRandomString($length = 8) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $randomString;
}

function generateRandomNumber() {
    $min = pow(10, 7); // Najmniejsza 8-cyfrowa liczba
    $max = pow(10, 8) - 1; // Największa 8-cyfrowa liczba
    return rand($min, $max);
}

function generateRandomEmail() {
    $username = generateRandomString();
    $domain = generateRandomString(5) . '.com'; // Możesz zmienić "com" na inny losowy sufiks domeny
    return $username . '@' . $domain;
}

function random(){
    $chars = '0123456789';
    $charsLength = 6;
    $str = '';
    
    for ($i = 0; $i < $charsLength; $i++)
        $str .= substr($chars, mt_rand(0, strlen($chars) -1), 1);
    
    return $str;
}

?>