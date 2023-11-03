<?php
function addTime($timer){
    $minutes_to_add = $timer;
    $time = new DateTime(date('Y-m-d H:i:s'));
    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
    $stamp = $time->format('Y-m-d H:i:s');
    return $stamp;
}
?>
