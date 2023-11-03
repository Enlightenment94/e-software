<?php
session_start();

if(isset($_SESSION['user']) && isset($_SESSION['code'])){
    echo "<a href='logout.php'>logout</a>";
}else{
    die();
}
?>