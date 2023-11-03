<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../static.php");
require_once("../sql/insertRecord.php");

$afo = "Każda dobra energia jest dobra";
$author = "Kamcio";
$otxt = "Otwórz umysł wykorzystaj wszystko.";

$tags = array("tag1");
insertRecord($afo, $author, $otxt, $tags);
?>
