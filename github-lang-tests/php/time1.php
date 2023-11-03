<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function addTime($timer){
    $minutes_to_add = $timer;
    $time = new DateTime(date('Y-m-d H:i:s a'));
    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
    $stamp = $time->format('Y-m-d H:i:s');
    return $stamp;
}

$timer = "5";
$res = addTime($timer);
echo $res . "</br>";

$timer = "60";
$res = addTime($timer);
echo $res . "</br>";

$timer = "48830";
$res = addTime($timer);
echo $res . "</br>";
?>
