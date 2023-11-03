<?php
    session_start();
    unset($_SESSION["use"]);
    unset($_SESSION["username"]);
    session_unset();
    session_destroy();   

    //echo 'You have cleaned session';
    echo ("<script>location.href='index.php';</script>");
    //header('Refresh: 3; URL = index.php');
    die();
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styleSmall.css">
    <link rel="stylesheet" href="css/stylejs.css">
    <title>TotalBurn</title>
</head>
<body>
    <div style='width:300px; margin: 0 auto;'>
        <canvas id="c"></canvas>
    </div>
    <script src="js/burn.js"></script>
</body>


