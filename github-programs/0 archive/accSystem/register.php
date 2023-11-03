<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("./static.php");
require_once("./sql/insertNotVerifyUser.php");
require_once("./sql/checkReg_userExist.php");
require_once("./sql/checkUserExist.php");
require_once("./sql/addVerifyUser.php");
require_once("./sql/verify.php");

function validateRegisterForm($email, $login, $pass, $repass){
    if($pass === $repass){
        
    }else{
        echo "Password is diffrent !!!.";
        return 1;
    }

    $ret = checkReg_userExist($login);
    if($ret == 2){
        echo "Table Reg_user problem or empty!!!";
        return 2;
    }

    if($ret == 1){
        echo "User exist in Reg_user !!!";
        return 1;
    }

    $ret = checkUserExist($login);
    if($ret == 2){
        echo "Table User problem!!!";
        return 2;
    }

    if($ret == 1){
        echo "User exist in user!!!";
        return 1;
    }
    return 0;
}

if(isset($_GET['e']) && isset($_GET['l']) && isset($_GET['p']) && isset($_GET['rp']) && isset($_GET['r'])){
    $email = $_GET['e'];
    $login = $_GET['l'];
    $pass = $_GET['p'];
    $repass = $_GET['rp'];
    $register = $_GET['r'];

    $ret = validateRegisterForm($email, $login, $pass, $repass);
    echo "</br>" . $ret . "</br>";
    if($ret != 1){
        $randValue = random_int(10000000, 99999999);
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
}

if( isset($_GET['i']) && isset($_GET['vr'])  && isset($_GET['vs']) ){
    $user_id = $_GET['i'];
    $verifyCode = $_GET['vr'];
    $ret = verify($user_id, $verifyCode);
    
    if($ret == 1){
        addVerifyUser($user_id);
    }
}
?>
<style>
    .form{
        border: black solid 1px;
        width: 200px;
        padding: 10px;
    }
    .label{
        
    }
    .in{
        margin-top: 5px;
        margin-bottom: 5px;
     }
    .in input{
        width: 200px;
     }
</style>

<div class='form'>
    <form action='register.php' method='get'>
        <div class='label'>email:</div><div class='in'><input name='e' value='email@mail.com' /></div>
        <div class='label'>login:</div><div class='in'><input name='l' value='login' /></div>
        <div class='label'>password:</div><div class='in'><input name='p' value='pass1' /></div>
        <div class='label'>repassword:</div><div class='in'><input name='rp' value='pass1' /></div>
        <div class='label'><input type='submit' name='r' value='register' /></div>
    </form>
</div>
