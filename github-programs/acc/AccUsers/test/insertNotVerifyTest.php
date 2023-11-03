<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../static.php");
require_once("../sql/insertNotVerifyUser.php");
$randValue = random_int(10000000, 99999999);
insertNotVerifyUser("user1", "password", "email@mail.com", $randValue);
?>
