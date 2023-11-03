<?php

require 'ls.php';

$my_string = "cxvhsvbds324.php is a random string with .php extension"; // Tutaj wpisz dowolny ciąg znaków

$arr = array("enlVir");
$base = "../";
$dir = ls_without($base, $arr);

foreach ($dir as $el) {
	if (preg_match('/\b[A-Za-z0-9]+\.(php)/', $el)) {
	    echo "Znaleziono losowy ciąg znaków z rozszerzeniem .php!" . $el . "</br>";
	} else {
	    //echo "Nie znaleziono losowego ciągu znaków z rozszerzeniem .php.";
	}
}
?>