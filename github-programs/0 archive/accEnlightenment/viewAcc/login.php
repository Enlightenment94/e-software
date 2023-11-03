<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../static.php");
require_once("../sqlAcc/login.php");

function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

session_start();

if(isset($_SESSION['use'])){
    header("Location: userPanel.php"); 
    die();
}

if( isset($_GET['u']) && isset($_GET['p']) ){
    $login = $_GET['u'];
    $pass = $_GET['p'];
    $ret = login($login, $pass);
    if($ret == 1){
        $_SESSION['use'] = generateRandomString();
        header("Location: userPanel.php");
        die();
    }else{
        echo "Bad login !!!";
    }
}
?>
<style>
    .form input{
        margin-bottom:5px;
        margin-top: 5px;
    }
</style>

<div class='form'>
    <form action='login.php' method='get'>
        username: <input name='u' value='Kamcio' /></br>
        password: <input name='p' value='pass1' /></br>
        <input type='submit' name='l' value='login' />
        <a href='register.php'>register</a>
    </form>
</div>
