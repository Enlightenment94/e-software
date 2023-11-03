<?php
session_start();
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

require_once("./static.php");
require_once("./sql/insertNotVerifyUser.php");
require_once("./sql/checkReg_userExist.php");
require_once("./sql/checkUserExist.php");
require_once("./sql/addVerifyUser.php");
require_once("./sql/verify.php");
require_once("./php/captcha.php");

function validateRegisterForm($email, $login, $pass, $repass){
    if($pass === $repass){
        
    }else{
        echo "Password is diffrent !!!.";
        return 1;
    }

    $ret = checkReg_userExist($login);
    if($ret == 2){
        echo "Table Reg_user problem or empty!!!";
        //return 2;
    }

    if($ret == 1){
        echo "User exist in Reg_user !!!";
        return 1;
    }

    $ret = checkUserExist($login);
    if($ret == 2){
        echo "Table User problem!!!";
        //return 2;
    }

    if($ret == 1){
        echo "User exist in user!!!";
        return 1;
    }
    return 0;
}

if(isset($_GET['e']) && isset($_GET['l']) && isset($_GET['p']) && isset($_GET['rp']) && isset($_GET['r']) && isset($_GET['cp'])){
    $email = $_GET['e'];
    $login = $_GET['l'];
    $pass = $_GET['p'];
    $repass = $_GET['rp'];
    $register = $_GET['r'];
    $cp = $_GET['cp'];

    //echo $_SESSION['captcha'];
    if($cp == $_SESSION['captcha']){
        echo "You are human !!!";
        $ret = validateRegisterForm($email, $login, $pass, $repass);
        echo "</br>" . $ret . "</br>";
        if($ret != 1){
            //$randValue = random_int(10000000, 99999999);
            $randValue = mt_rand(10000000, 99999999);
            echo "Verify number: " . $randValue;

            $lastId = insertNotVerifyUser($login, $pass, $email, $randValue);
            if($lastId == 0){
                echo "Something wrong with last id !!!";
            }else{
                $verifyForm = "<form action='./register.php'>";
                $verifyForm .= "<input type='hidden' name='i' value='" . $lastId . "'/>";
                $verifyForm .= "verify reg: <input type='text' name='vr' value=''/>";
                $verifyForm .= "<input type='submit' name='vs' value='verify'/>";
                $verifyForm .= "</form>";
                echo $verifyForm;
            }
        }
    }else{
        echo "Are you human ??";
    }
}

if( isset($_GET['i']) && isset($_GET['vr'])  && isset($_GET['vs']) ){
    $user_id = $_GET['i'];
    $verifyCode = $_GET['vr'];
    $ret = verify($user_id, $verifyCode);
    
    if($ret == 1){
        addVerifyUser($user_id);
        unset($_SESSION['captcha']);
    }
}
?>
<html>
<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class='content'>
    <center><img src='logo.jpeg' width='222' height='200'/></center>
    <div class='form'>
        <form action='register.php' method='get'>
            <div class='label'>email:</div><div class='in'><input name='e' value='email@mail.com' /></div>
            <div class='label'>login:</div><div class='in'><input name='l' value='login' /></div>
            <div class='label'>password:</div><div class='in'><input name='p' value='pass1' /></div>
            <div class='label'>repassword:</div><div class='in'><input name='rp' value='pass1' /></div>
            <div class='label'>captcha:</div><div class='in'><input name='cp' value='' /></div>
            <?php
            ob_start();
            $str = random();
            $_SESSION['captcha'] = $str;
            captcha($str);
            $image = ob_get_contents();
            $data = base64_encode($image);
            ob_clean();
            echo "<img src='data:image/png;base64," . $data . "'/>";
            ?>
            <div style='margin-top: 5px;'>
                <input type='submit' name='r' value='register'/>
                <a href='index.php'>back</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
