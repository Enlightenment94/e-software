<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../static.php");
require_once("../sql/insertRecord.php");

$afo = "Wszystko należy upraszczać jak się da, ale nie bardziej";
$author = "Albert Einstein";
$otxt = "Otwórz umysł wykorzystaj wszystko.";

$tags = array("tag1", "tag2", "tag3");
insertRecord($afo, $author, $otxt, $tags);
?>
