<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
require_once 'myNsClass.php';
$obj = new MyNsClass();

Fatal error: Uncaught Error: Class "MyNsClass" not found in /opt/lampp/htdocs/dspace/elight/www/2 I/it/php/namespace/index.php:8 Stack trace: #0 {main} thrown in /opt/lampp/htdocs/dspace/elight/www/2 I/it/php/namespace/index.php on line 8
*/

require_once 'myNsClass.php';

use myNs\MyNsClass;

$obj = new MyNsClass();
$obj->hello();

//Hello !!!
?>
