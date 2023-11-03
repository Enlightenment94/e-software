<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../static.php");
require_once("../sql/dropTable.php");
$dropTable = array($GLOBALS['beforeTags'] . $table, $GLOBALS['beforeIds'] . $table, $table);
dropTable($dropTable);
?>
