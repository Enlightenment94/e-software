<?php
require_once("../secretStatic.php");
require_once("aes.php");

echo decryptKey("private.key", $sp);
?>