<?php
$gServername = "localhost";
$gUsername = "root";
$gPassword = "";
$gDbname = "dbs";

$gNoteTable = "MyStack";
$fp = fopen("stack", "r");
$rd = fread($fp, filesize("stack"));
fclose($fp);
$gNoteTable = $rd;

$gIdsTagsTable = "ids_" . $gNoteTable;
$gTagsTable = "tags_" . $gNoteTable;
$gStacksTable = "stacks";

$gBackUpPath = "../bp";
?>
