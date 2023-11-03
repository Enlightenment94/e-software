<?php
session_start(); // inicjuje sesję

session_unset(); // usuwa wszystkie zarejestrowane zmienne sesji

session_destroy(); // usuwa sesję

header('Refresh: 3; URL = ../index.php');
die();
?>