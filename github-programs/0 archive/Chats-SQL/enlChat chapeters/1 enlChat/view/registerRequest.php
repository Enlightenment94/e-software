<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../static.php');
require_once('../php/rand.php');
require_once('../sql/insertUser.php');
require_once('../php/validateFunctions.php');
require_once('../sql/insertPublicKey.php');
require_once('../sql/selectUser_id.php');

//u  - username
//p  - password
//rp - repassword
//c  - captcha
//rpk - rsa public key
if(isset($_GET['u']) && isset($_GET['p']) && isset($_GET['rp']) && isset($_GET['c']) && isset($_GET['rpk'])){
    //Validate
    //Validate is number, length $_GET['c']
    $user = $_GET['u'];
    $pass = $_GET['p'];
    $repass = $_GET['rp'];
    $captcha = $_GET['c'];
    $rsaPublicKey = $_GET['rpk']; //walidacje zrobić
    //checkUserExist !!!!
    if(checkValidateUsername($user) && checkValidatePassword($pass) && checkValidatePassword($repass) && checkValidateCaptcha($captcha)){
        $sessionCaptcha = $_SESSION['captcha'];
        if($captcha == $sessionCaptcha){
            echo "You are human.";
            insertUser($user, $pass);
            $user_id = selectUser_id($user);
            insertPublicKey($user_id, $rsaPublicKey);
            session_unset();
            session_destroy();
            header('Location: ../index.php');
            die();
        }else{
            echo "You are not human.";
        }       
    }else{
        echo "Wrong input data.";
    }
}
?>
