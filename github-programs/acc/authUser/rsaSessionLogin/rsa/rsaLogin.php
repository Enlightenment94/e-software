<?php
session_start();
require_once("secretStatic35334543e62ds.php");
require_once("aes.php");
require_once("rsa.php");
require_once("../php/validate.php");
    
if(isset($_POST['u']) && isset($_POST['p']) && isset($_POST['c'])){
    $userEncrypted = $_POST['u'];
    $passwordEncrypted = $_POST['p'];
    $captchaEncrypted = $_POST['c'];

    $v1 = encryptedCheck($userEncrypted);
    $v2 = encryptedCheck($passwordEncrypted);
    $v3 = encryptedCheck($captchaEncrypted);

    if($v1 != 1 || $v2 != 1 || $v3 !=1){
        die();
    }
    
    //echo count($userEncrypted);
    //echo count($passwordEncrypted);
    //echo count($captchaEncrypted);
    //echo $userEncrypted . "</br>\n";
    //echo $passwordEncrypted . "</br>\n";

    $privateKey = decryptKey('private.key', $sp);
    //$privateKey = openssl_pkey_get_private(file_get_contents('private.key'));
    $privateKey = openssl_pkey_get_private($privateKey);

    $captcha = rsaDecrypt($captchaEncrypted, $privateKey);
    $userDecrypted = rsaDecrypt($userEncrypted, $privateKey);
    $passwordDecrypted = rsaDecrypt($passwordEncrypted, $privateKey);

    if($userDecrypted == "err_decrypt" || $passwordDecrypted == "err_decrypt"){
        die();        
    }

    $v1 = check255($passwordDecrypted);
    $v2 = check255($userDecrypted);
    $v3 = checkCaptcha($captcha);
    if($v1 != 1 || $v2 != 1 || $v3 != 1){
        die();
    }

    if($captcha == $_SESSION['captcha']){
        //echo "You are human.";
    }else{
        echo "You are not human, mistake or low IQ people.";
        die();
    }

    // pobiera dane z formularza i wykonuje zapytanie do bazy danych
    $username = encodeSpecialChars($userDecrypted);
    $password = encodeSpecialChars($passwordDecrypted);

    /*Check login*/
    if($username == "sudo" && $password == "sudo_LOG"){
        echo "window.location.href='app/dashboard.php'";

    }
}
?>