<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if(isset($_SESSION['use'])){

}else{
    header("Location: login.php");
    die();
}

echo "Session On</br>";
echo "<a href='logout.php'>logout</a>";
?>


