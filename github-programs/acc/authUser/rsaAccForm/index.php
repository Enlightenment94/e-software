<?php
session_start();
require_once('php/func.php');
require_once('humanTests/captcha.php');

ob_start();
$str = random();
captcha($str);
$image = ob_get_contents();
$data = base64_encode($image);
ob_clean();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login form</title>
    <script src='lib/jsencrypt-master/bin/jsencrypt.min.js'></script>
    <script src='form/rsaCli.js'></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if(isset($error_message)): ?>
        <div style="color: red;"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <center><img id='logo' src='logo.jpeg' width='100' height='100'/></center>
    <div id='window'>
        <form method="POST" action="simple/login.php">

            <div class='label-col'>
                <label for="username">username:</label>
            </div>

            <div class='input-col'>
                <input id='username' type="text" name="username" value='kamil' required>
            </div>

            <div class='label-col'>
                <label for="password">password:</label>
            </div>

            <div class='input-col'>
                <input id='password' type="password" name="password" value='abcd' required>
            </div>

            <div class='label-col'>
                <label for="captcha">captcha:</label>   
            </div>
            <?php
            ?>
            <div class='input-col'>
                <input id='captcha' type="text" value="<?php echo $str; ?>" name="captcha" required>
            </div>

            <div class='input-col-end'>
                <?php
                $_SESSION['captcha'] = $str;
                echo "<center><img src='data:image/png;base64," . $data . "'/></center>";
                ?>
                <script>
                var captchaImg = document.getElementById('captchaImg');
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'humanTests/captcha.png');
                xhr.responseType = 'arraybuffer';

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var captchaBlob = new Blob([xhr.response], {type: 'image/png'});
                        var captchaUrl = URL.createObjectURL(captchaBlob);
                        captchaImg.src = captchaUrl;
                        console.log(captchaImg.src);
                        console.log(captchaUrl);
                        console.log(captchaBlob);
                        console.log(xhr.response);
                    }
                };
                xhr.send();
                </script>
            </div>
                    
            <button class='btn' id='login-button' type="submit">login</button>
        </form>

        <div class='window-line'>
            <button class='btn' id='rsa-login-button' type="submit" onclick='login()'>RSA-login</button>
        </div>

        <div class='window-line'>
            <button class='btn' id='public-key' type="submit" onclick='getPublicKeyLogin()'>publicKey</button>
        </div>

        <div class='window-line'>
            <a href='form/registerForm.php'>register</a>
        </div>
        <div class='window-line'>
            <a id='a-users' href='init/users.php'>users</a>
        </div>
        <div class='window-line100'><pre><p id='temp'></p></pre></div>
    </div>
    <div id='description-window'>
    </div>
</body>
 </html>