<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../static.php");
require_once("../sql/checkUserExist.php");
require_once("../sql/checkReg_userExist.php");

$isUserExist = "user1";
$checkUser = checkReg_userExist($isUserExist);
echo $checkUser;

echo "<br></br>";

$isUserExist = "user2";
$checkUser = checkReg_userExist($isUserExist);
echo $checkUser;

echo "<br></br>";

$isUserExist = "user1";
$checkUser = checkUserExist($isUserExist);
echo $checkUser;
?>

