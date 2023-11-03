<?php
session_start();
if(isset($_SESSION['use'])){

}else{
    header("Location: secretLogin.php");
    die();
}

echo "Session On</br>";
echo "<a href='logout.php'>logout</a>";
?>
