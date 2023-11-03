<?php
session_start();
require_once('php/captcha.php');

ob_start();
$str = random();
$_SESSION["captcha"] = $str;
captcha($str);
$image = ob_get_contents();
$data = base64_encode($image);
ob_clean();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Dziwn zależność
?>
<form action='view/registerRequest.php' method='get'>
    <div class='label'>username:</div><div class='input-register'><input name='u' value='login' /></div>
    <div class='label'>password:</div><div class='input-register'><input name='p' value='pass1' /></div>
    <div class='label'>repassword:</div><div class='input-register'><input name='rp' value='pass1' /></div>
    <div class='label'>captcha:</div><div class='input-register'><input name='c' value='' /></div>
    <?php
    echo "<div><img src='data:image/png;base64," . $data . "'/></div>";
    ?>
    <div class='label'><input type='submit' name='r' value='register' /></div>
</form>
