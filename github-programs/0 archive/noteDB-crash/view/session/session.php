<?php
session_start();
if(isset($_SESSION['use'])){

}else{
    header("Location: session/secretLogin.php");
    die();
}

//echo "Session On</br>";
?>
