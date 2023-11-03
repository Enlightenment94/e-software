<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../static.php");
require_once("../sql/updateRecord.php");

require_once("createTableTest.php");
require_once("insertTagTest.php");
require_once("insertRecordTest.php");

$by = "1";
$afo = "Changed - Każda dobra energia jest dobra";
$author = "Changed Kamcio";
$otxt = "Changed text1";
$tags = array("tag1");

updateRecord($by, $afo, $author, $otxt, $tags);
?>
