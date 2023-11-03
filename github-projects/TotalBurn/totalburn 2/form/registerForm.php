<?php
session_start();
require_once('../php/func.php');

require_once('../humanTests/captcha.php');
ob_start();
$str = random();
captcha($str);
$image = ob_get_contents();
$data = base64_encode($image);
ob_clean();
?>

<script src='../lib/jsencrypt-master/bin/jsencrypt.min.js'></script>
<script src='rsaCli.js'></script>

<head>
    <link rel="stylesheet" href="../style.css">
</head>
    <script language="JavaScript" type="text/javascript" src="../lib/cryptoico/jsbn.js"></script>
    <script language="JavaScript" type="text/javascript" src="../lib/cryptoico/random.js"></script>
    <script language="JavaScript" type="text/javascript" src="../lib/cryptoico/hash.js"></script>
    <script language="JavaScript" type="text/javascript" src="../lib/cryptoico/rsa.js"></script>
    <script language="JavaScript" type="text/javascript" src="../lib/cryptoico/aes.js"></script>
    <script language="JavaScript" type="text/javascript" src="../lib/cryptoico/api.js"></script>
    <script>
    function createPubKey(){
        var passPharse1 = document.getElementById('pharseKey').value;

        var bits = 2048; 

        var rsaKeys1 = cryptico.generateRSAKey(passPharse1, bits);
        var publicKey1 = cryptico.publicKeyString(rsaKeys1)
            
        document.getElementById('pubArea').value = publicKey1;
    }
    window.onload = function() {
        createPubKey();
    };
    </script>

<body>
    <center><img id='logo' src='../logo.jpeg' width='100' height='100'/></center>
    <div id='window'>
        <div class='window-line100'>
            <button class='btn' id='rsa-register-button' type="submit" onclick='createPubKey()'>public_key_2048</button>
        </div>

        <form id='register' method="POST" action="../simple/register.php">
            <div class='label-col'>
                <label for="username">username:</label>
            </div>
            <div class='input-col'>
                <input type="text" id='username' name="u" required value="<?php echo generateRandomString();?>">
            </div>

            <div class='label-col'>
                <label for="password">password:</label>
            </div>

            <div class='input-col'>
                <input type="password" id='password' name="p" value="<?php echo "abcd"?>" required>
            </div>

            <div class='label-col'>
                <label for="pharseKey">pharse_key:</label>
            </div>
            
            <div class='input-col'>
                <input type="password" id='pharseKey' value="<?php echo "abcd"?>" required>
            </div>

            <div class='label-col'>
                <label for="captcha">captcha:</label>   
            </div>
            <div class='input-col'>
                <input id='captcha' type="text" value="<?php //echo $str; ?>" name="captcha" required>
            </div>

            <div class='input-col-end'>
                <?php
                $_SESSION['captcha'] = $str;
                echo "<center><img src='data:image/png;base64," . $data . "'/></center>";
                ?>
            </div>
            
            <textarea id='pubArea' form='register' name='pbk' style='width: 100%; height: 300px; margin-bottom: 10px;'></textarea>
        </form>

        <div class='window-line100'>
            <button class='btn' id='rsa-register-button' type="submit" onclick='register()'>register</button>
        </div>

        <div class='window-line100'>
            <a href='../index.php'>back</a>
        </div>

        <div class='window-line100'><p id='temp'></p></div>
    </div>
</body>