<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../static.php");
require_once("../sql/insertRecord.php");

$afo = "Sztuki walki to zwycięztwo umysłu nad siłą";
$author = "Kamcio";
$otxt = "Walcz głową.";

$tags = array("tag1", "tag2");
insertRecord($afo, $author, $otxt, $tags);
?>
