<?php
session_start(); // inicjuje sesję

session_unset(); // usuwa wszystkie zarejestrowane zmienne sesji

session_destroy(); // usuwa sesję

//echo 'You have cleaned session';
echo ("<script>location.href='../index.php';</script>");
//header('Refresh: 3; URL = index.php');
die();
?>