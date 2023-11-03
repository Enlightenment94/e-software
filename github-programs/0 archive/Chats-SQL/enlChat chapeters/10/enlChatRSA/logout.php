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
</body>
<?php
    session_start();
    unset($_SESSION["use"]);
    unset($_SESSION["username"]);
    session_unset();
    session_destroy();   

    //echo 'You have cleaned session';
    header('Refresh: 3; URL = index.php');
    die();
?>

