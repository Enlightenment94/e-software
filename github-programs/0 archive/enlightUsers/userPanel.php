<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if(isset($_SESSION['use'])){

}else{
    header("Location: index.php");
    die();
}
echo "<pre>Welcome to Enlightenment !!! 
Web is bulding ..." . "</pre>";
echo "<a href='logout.php'>logout</a>";
?>


