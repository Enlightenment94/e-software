<?php
session_start();
require_once('../php/func.php');
require_once('../humanTests/captcha.php');

ob_start();
$str = random();
captcha($str);
$image = ob_get_contents();
$data = base64_encode($image);
ob_clean();

?>
<script src='../lib/jsencrypt-master/bin/jsencrypt.min.js'></script>
<script src='../form/rsaCli.js'></script>

<head>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <center><img id='logo' src='../logo.jpeg' width='100' height='100'/></center>
    <div id='window'>
        <form method="POST" action="../simple/register.php">
            <div class='label-col'>
                <label for="username">username:</label>
            </div>
            <div class='input-col'>
                <input type="text" id='username' name="username" required value="<?php echo generateRandomString();?>">
            </div>

            <div class='label-col'>
                <label for="password">password:</label>
            </div>
            <div class='input-col'>
                <input type="password" id='password' name="password" value="<?php echo "abcd"?>" required>
            </div>

            <div class='label-col'>
                <label for="email">email:</label>
            </div>
            <div class='input-col'>
                <input type="email" id='email' name="email" value="<?php echo generateRandomEmail();?>" required>
            </div>

            <div class='label-col'>
                <label for="captcha">captcha:</label>   
            </div>
            <div class='input-col'>
                <input id='captcha' type="text" value="<?php //echo $str; ?>" name="captcha" required>
            </div>

            <div class='input-col-end'>
                <?php
                $_SESSION['captcha'] = $str;
                echo "<center><img src='data:image/png;base64," . $data . "'/></center>";
                ?>
            </div>
                    
            <button class='btn' id='login-button' name='submit' type="submit">register</button>
        </form>

        <div class='window-line100'>
            <button class='btn' id='rsa-register-button' type="submit" onclick='register()'>rsa-register</button>
        </div>

        <div class='window-line100'>
            <a href='../index.php'>back</a>
        </div>

        <div class='window-line100'><pre><p id='temp'></p></pre></div>
    </div>
</body>