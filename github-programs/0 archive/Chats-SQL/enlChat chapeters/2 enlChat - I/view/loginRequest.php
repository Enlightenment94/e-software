<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../static.php');
require_once('../php/rand.php');
require_once('../sql/login.php');

if(isset($_GET['u']) && isset($_GET['p'])){
    $user = $_GET['u'];
    $pass = $_GET['p'];
    if(login($user, $pass)){
        $_SESSION['use'] = rand();
        $_SESSION['username'] = $user;
        header("Location: userPanel.php");
        die();
    }else{
        echo "Bad login."; 
    }
}
?>
