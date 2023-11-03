<style>
input{
    width: 100%;
    margin: 5px;
}

button{
    width: 100%;
    margin: 5px;    
}

#container-form{
    width: 300px;
    margin: 0 auto;
    background-color: gray;
}
</style>

<center><img src='logo.jpeg' alt='logo'/></center>
<div id='container-form'>
    <form action='./rsa/rsaLogin.php' method='post'>
        <div>
            <input id='username' name='u' value='sudo'/>
        </div>

        <div>
            <input id='password' name='p' value='sudo_LOG'/>
        </div>

        <div>
            <?php 
            session_start();
            $_SESSION['captcha'] = "5463";
            ?>
            <input id='captcha' name='c' value='5463'/>
        </div>
    </form>

    <script src='lib/jsencrypt-master/bin/jsencrypt.min.js'></script>
    <script src='js/rsaCli.js'></script>
    <button onclick='login()'>login</button>
    <div id='temp'></div>
</div>