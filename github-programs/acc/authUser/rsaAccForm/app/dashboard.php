<?php
session_start(); 

if(isset($_SESSION['username']) && isset($_SESSION['id'])) { 
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
    echo "Witaj, $username!"; 
    echo "<br>";
    echo "<a href='../form/logout.php'>logout</a>"; 
} else {
    echo ("<script>location.href='index.php';</script>");
    //echo "<script>window.location.href = './index.php';</script>";
    //header('Location: index.php');
    exit;
}
?>