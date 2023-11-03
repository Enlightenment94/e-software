<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function random(){
    $chars = '0123456789';
    $charsLength = 7;
    $str = '';
    
    for ($i = 0; $i < $charsLength; $i++)
        $str .= substr($chars, mt_rand(0, strlen($chars) -1), 1);
    
    return $str;
}

function captcha($str){
    $width = 170;       
    $height = 30;       
    
    $string = $str;

    $im = imagecreate($width, $height);
    
    //kolory obrazka
    $back     = imagecolorallocate($im,0,0,0);
    $font   = imagecolorallocate($im,255,255,255);
    $wipe   = imagecolorallocate($im,78,78,78);
    $border = imagecolorallocate ($im, 255, 0, 0);
    
    imagefill($im,1,1,$back);
    
    for($i=0; $i<1600; $i++)
    {
        $rand1 = rand(0,$width);
        $rand2 = rand(0,$height);
        imageline($im, $rand1, $rand2, $rand1, $rand2, $wipe);
    }
    
    $x = rand(5, $width/(7/2));
    
    imagerectangle($im, 0, 0, $width-1, $height-1, $border);
    
    for($a=0; $a < 7; $a++)
    {
        imagestring($im, 6, $x, rand(4 , $height/5), substr($string, $a, 1), $font);
        $x += (5*3);
    }
    
    imagegif($im);
    imagedestroy($im);
}


ob_start();
$str = random();
captcha($str);
$image = ob_get_contents();
$data = base64_encode($image);
ob_clean();

echo "<h1> hello </h1>";
echo "<img src='data:image/png;base64," . $data . "'/>";



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
        //$randValue = random_int(10000000, 99999999);
        //echo "Verify number: ";

        $lastId = insertNotVerifyUser($login, $pass, $email, $str);
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
    .content{
        width: 200px;
        margin: 0 auto;
    }
</style>

<html>
<head>
    <meta charset='utf-8'>
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
            <input type='submit' name='r' value='register'/>
            <a href='index.php'>back</a>
        </form>
    </div>
</div>
</body>
</html>
