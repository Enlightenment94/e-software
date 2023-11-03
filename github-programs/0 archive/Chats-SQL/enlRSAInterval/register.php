<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('static.php');
require_once('sql/createTable.php');
require_once('sql/insertUser.php');
require_once('sql/createChat.php');
require_once('sql/selectUserId.php');
require_once('sql/sendMessage.php');
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styleSmall.css">
    <link rel="stylesheet" href="css/stylejs.css">
    <title>Enlightenmentsoftware - enlRSAchat</title>
</head>
<body>
    <script language="JavaScript" type="text/javascript" src="js/cryptoico/jsbn.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/cryptoico/random.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/cryptoico/hash.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/cryptoico/rsa.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/cryptoico/aes.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/cryptoico/api.js"></script>
    <script>
    function createPubKey(){
        var passPharse1 = document.getElementById('rsa1').value;
        var passPharse2 = document.getElementById('rsa2').value;

        var bits = 1024; 

        var rsaKeys1 = cryptico.generateRSAKey(passPharse1, bits);
        var publicKey1 = cryptico.publicKeyString(rsaKeys1)

        var rsaKeys2 = cryptico.generateRSAKey(passPharse2, bits);
        var publicKey2 = cryptico.publicKeyString(rsaKeys2);
        
        document.getElementById('area1').value = publicKey1;
        document.getElementById('area2').value = publicKey2;
    }
    </script>
    <canvas id="matrix"></canvas>
    <script src="js/matrix.js"></script>
    <div id='banner'></div>
    <div id='body'>
        <center><img style="margin-top: 10px;" src='logo.jpeg' width='100px' height='100px'/></center>
        <h2 class='header'>Enlightenmentsoftware - enl<span style="color: crimson;
; text-shadow: 1px 1px rgba(255, 55, 55, 0.6);">RSA</span>chat</h2>
        <div style="height: 30px;">
            <center><a class='githubLink' href='https://github.com/Enlightenment94/e-software'>https://github.com/Enlightenment94/e-software</a></center>
        </div>

            <div style='margin: 0 auto; width: 200px;'>
                <button class="button-chat button-del" style='width: 175px;' onclick='createPubKey()'>Create_pub_key</button>

                <form id='reg1' action='request.php' method='get'>
                    <div style='margin-top: 5px; margin-bottom: 5px;'>username:</div>
                    <div><input type='text' name='u' value='user_1' /></div>
                    <div style='margin-top: 5px; margin-bottom: 5px;'>password:</div><div><input type='password' name='p' value='pass1' /></div>
                    <div style='margin-top: 5px; margin-bottom: 5px;'>repassword:</div><div><input type='password' name='rp' value='pass1' /></div>
                    <div style='margin-top: 5px; margin-bottom: 5px;'>RSA:</div><div><input id='rsa1' type='password' name='r' value='rsapass1' /></div>
                    <div style='margin-top: 5px; margin-bottom: 5px;'>reRSA:</div><div><input id='rsa2' type='password' name='r' value='rsapass1' /></div>
                    <div style='margin-top: 5px; margin-bottom: 5px;'>pub_key:</div><div><textarea id='area1' name='pk' form='reg1'></textarea></div>
                    <input class="button-chat button-del" style='margin-top: 5px; width: 100px;' type='submit' name='r' value='register' />
                    <a href='index.php'>back</a>
                </form>
            </div>

    </div>
    <div id='footer'></div>
</body>

