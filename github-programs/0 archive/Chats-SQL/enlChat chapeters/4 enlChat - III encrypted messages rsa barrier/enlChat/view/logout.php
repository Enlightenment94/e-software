<?php
    session_start();
    unset($_SESSION["use"]);
    unset($_SESSION["username"]);
    session_unset();
    session_destroy();   

    echo 'You have cleaned session';
    header('Refresh: 2; URL = ../index.php');
    die();
?>
