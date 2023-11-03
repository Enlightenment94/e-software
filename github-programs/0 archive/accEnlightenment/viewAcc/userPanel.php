<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../static.php');
require_once('../entity/User.php');
require_once('../sqlAcc/selectAllUsers.php');

session_start();
if(isset($_SESSION['use'])){
    echo $_SESSION['use'] . "</br>";
}else{
    header("Location: login.php");
    die();
}

echo "Session On</br>";
echo "<a href='logout.php'>logout</a>";
echo "<br></br>";

$arrUsers = selectAllUsers();
foreach($arrUsers as $user){
    echo $user->getUser_id() . " " . $user->getLogin() . "</br>";
}
?>



