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
        <script language="JavaScript" type="text/javascript" src="js/cryptoico/jsbn.js"></script>
        <script language="JavaScript" type="text/javascript" src="js/cryptoico/random.js"></script>
        <script language="JavaScript" type="text/javascript" src="js/cryptoico/hash.js"></script>
        <script language="JavaScript" type="text/javascript" src="js/cryptoico/rsa.js"></script>
        <script language="JavaScript" type="text/javascript" src="js/cryptoico/aes.js"></script>
        <script language="JavaScript" type="text/javascript" src="js/cryptoico/api.js"></script>

<script>
function pharseToKey(){
    var passPharse = document.getElementById('pharse').value;
    var bits = 1024; 

    var rsaKeys = cryptico.generateRSAKey(passPharse, bits);

    var publicKey = cryptico.publicKeyString(rsaKeys);    
    document.getElementById('area').innerHTML = publicKey;
}
</script>

<div class='label'>RSApassword:</div>
<div class='input-register'>
    <input id='pharse' type='text' value='My pharseKey' />
    <button onclick='pharseToKey()'>pharse</button>
</div>

<form id='reg' action='view/registerRequest.php' method='get'>
    <div class='label'>username:</div><div class='input-register'><input name='u' value='login' /></div>
    <div class='label'>password:</div><div class='input-register'><input name='p' value='pass1' /></div>
    <div class='label'>repassword:</div><div class='input-register'><input name='rp' value='pass1' /></div>
    <textarea id='area' form='reg' name='rpk'></textarea>
    <div class='label'>captcha:</div><div class='input-register'><input name='c' value='' /></div>
    <?php
    echo "<div><img src='data:image/png;base64," . $data . "'/></div>";
    ?>
    <div class='label'><input type='submit' name='r' value='register' /></div>
</form>
