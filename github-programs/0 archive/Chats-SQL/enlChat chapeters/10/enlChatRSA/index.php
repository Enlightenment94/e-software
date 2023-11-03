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
        <div id='console'>
             <div style='margin: 0 auto; width: 200px;'>
                <form action='request.php' method='get'>
                    <div style='margin-top: 5px; margin-bottom: 5px;'>username:</div>
                    <div><input type='text' name='u' value='user_1' /></div>
                    <div style='margin-top: 5px; margin-bottom: 5px;'>password:</div>
                    <div><input type='text' name='p' value='pass1' /></div>
                    <input class="button-chat button-del" style='width: 100px;' type='submit' name='l' value='login' />
                    <a href='register.php' style='margin-left: 10px;'>register</a>
                </form>
                <a href='up.php'>up</a>
            </div>
        </div>
    </div>
    <div id='footer'></div>
</body>

