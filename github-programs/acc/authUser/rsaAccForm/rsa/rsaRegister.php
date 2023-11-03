<?php
session_start();
require_once('../php/func.php');
require_once('../form/static.php');
require_once("secretStatic35334543e62ds.php");
require_once("rsa.php");
require_once("aes.php");
require_once('../php/validate.php');

if(isset($_POST['u']) && isset($_POST['p']) && isset($_POST['c']) && $_POST['e']){
    $userEncrypted = $_POST['u'];
    $passwordEncrypted = $_POST['p'];
    $captchaEncrypted = $_POST['c'];
    $emailEncrypted = $_POST['e'];

    $v1 = encryptedCheck($userEncrypted);
    $v2 = encryptedCheck($passwordEncrypted);
    $v3 = encryptedCheck($emailEncrypted);
    $v4 = encryptedCheck($captchaEncrypted);

    if($v1 != 1 || $v2 != 1 || $v3 !=1 || $v4 != 1){
        die();
    }

    $privateKey = decryptKey('private.key', $sp);
    $privateKey = openssl_pkey_get_private($privateKey);


    $captcha = rsaDecrypt($captchaEncrypted, $privateKey);
    $userDecrypted = rsaDecrypt($userEncrypted, $privateKey);
    $passwordDecrypted = rsaDecrypt($passwordEncrypted, $privateKey);
    $emailDecrypted = rsaDecrypt($emailEncrypted, $privateKey);

    if($userDecrypted == "err_decrypt" || $passwordDecrypted == "err_decrypt" || $emailDecrypted == "err_decrypt"){
        die();        
    }

    $v1 = check255($passwordDecrypted);
    $v2 = check255($userDecrypted);
    $v3 = check255($emailDecrypted);
    $v4 = checkCaptcha($captcha);
    if($v1 != 1 || $v2 != 1 || $v3 != 1 || $v4 != 1){
        die();
    }

    if($captcha == $_SESSION['captcha']){
        //echo "You are human.";
    }else{
        echo "You are not human, mistake or low IQ people.";
        die();
    }

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $username = encodeSpecialChars($userDecrypted);
        $password = encodeSpecialChars($passwordDecrypted);
        $email = encodeSpecialChars($emailDecrypted);

        $sql = "SELECT id FROM `users2` WHERE `username`='$username' OR `email`='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "Użytkownik o podanej nazwie lub adresie e-mail już istnieje.";
        } else {
            // dodaje użytkownika do bazy danych
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_sql = "INSERT INTO `users2` (`username`, `password`, `email`) VALUES ('$username', '$hashed_password', '$email')";

            if (mysqli_query($conn, $insert_sql)) {
                echo "Nowy użytkownik został dodany do bazy danych!";
            } else {
                echo "Błąd: " . mysqli_error($conn);
            }
        }

        mysqli_close($conn);
}
?>