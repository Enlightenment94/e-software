<html>
    <head>
        <link rel="stylesheet" href="style.css" />
    </head>
<body>
        <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        ?>
<?php
function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

session_start();

if(isset($_SESSION['use'])){
    echo $_SESSION['use'];
    header("Location: session/session.php"); 
    die();
}

if(isset($_GET['login'])){
    $user = $_GET['user'];
    $pass = $_GET['pass'];

    if($user == "sudo" && $pass == "pass1234"){
        $_SESSION['use'] = generateRandomString();
        header("Location: ../showView2.php");
        die();
    }else{
        echo "invalid UserName or Password";        
    }
}
?>
    <div id='banner'></div>
    <div id='menu'>
    </div>

    <div id='content'>
        <form action='secretLogin.php' method='GET'>
            <input name='user' type='text' value='sudo' />
            <input name='pass' type='text' value='pass1234' />
            <input name='login' type='submit' value='login' />
        </form>
    </div>

    <div id='foot'></div>
</body>
</html>
