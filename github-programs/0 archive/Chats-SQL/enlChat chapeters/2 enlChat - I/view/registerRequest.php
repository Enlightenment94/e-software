<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../static.php');
require_once('../php/rand.php');
require_once('../sql/insertUser.php');

session_start();
//u  - username
//p  - password
//rp - repassword
//c  - captcha
if(isset($_GET['u']) && isset($_GET['p']) && isset($_GET['rp']) && isset($_GET['c'])){
    //Validate
    //Validate is number, length $_GET['c']
    $user = $_GET['u'];
    $pass = $_GET['p'];
    $repass = $_GET['rp'];
    $captcha = $_GET['c'];
    $sessionCaptcha = $_SESSION['captcha'];
    if($captcha == $sessionCaptcha){
        echo "You are human.";
        insertUser($user, $pass);
        session_unset();
        session_destroy();
        header('Location: ../index.php');
        die();
    }else{
        echo "You are not human.";
    }
}
?>
