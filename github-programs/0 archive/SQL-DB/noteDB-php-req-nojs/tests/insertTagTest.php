<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../static.php");
require_once("../sql/insertTag.php");
$tagRec = "tag1";
insertTag($tagRec);

$tagRec = "tag2";
insertTag($tagRec);

$tagRec = "tag3";
insertTag($tagRec);
?>