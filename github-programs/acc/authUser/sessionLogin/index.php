<style>
input{
    width: 100%;
    margin: 5px;
}

#logo{
    border-radius: 50%;
    border: 3px solid silver;
    width: 100px;
    height: 100px;
}

#container-form{
    width: 300px;
    margin: 0 auto;
    background-color: gray;
}
</style>

<?php
session_start();
if(isset($_POST['u']) && isset($_POST['p']) && isset($_POST['l'])){
    $user = $_POST['u'];
    $password = $_POST['p'];
    $login = $_POST['l'];
    if($user == 'sudo' && $password == 'enlBlog94'){
        $_SESSION['user'] = 'sudo';
        $_SESSION['code'] = '4632';
        header("Location: dashboard.php");
    }
}
?>

<div>
    <center><img id='logo' src='logo.jpeg' alt='logo'/></center>
</div>
<br>
<div id='container-form'>
    <form action='./' method='post'>
        <div>
            <input name='u' value=''/>
        </div>
        <div>
            <input name='p' type='password' value=''/>
        </div>
        <div>
            <input name='l' type='submit' value=''/>
        </div>
    </form>
</div>