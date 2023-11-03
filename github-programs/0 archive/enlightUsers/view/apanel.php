<head>
	<meta charset="utf-8">
</head>
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

session_start();
require_once("../static.php");
require_once("../sql/createAccTable.php");

if(isset($_SESSION['use'])){

}else{
    header("Location: session/secretLogin.php");
    die();
}

if(isset($_GET['b'])){
    createAccTable("users");
}
?>
<form action='apanel.php'>
    <input type='submit' name='b' value='bulid'/>
</form>

