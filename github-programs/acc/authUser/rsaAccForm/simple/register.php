<?php
session_start();
require_once('../php/func.php');
require_once('../form/static.php');
require_once('../php/validate.php');

if(isset($_POST['captcha'])){
    $captcha = $_POST['captcha'];
    if($captcha == $_SESSION['captcha']){
        echo "You are human.";
    }else{
        echo "You are not human, mistake or low IQ people.";
        die();
    }

    if(isset($_POST['submit'])) {

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $username = encodeSpecialChars($username);
        $password = encodeSpecialChars($password);
        $email = encodeSpecialChars($email);

        $sql = "SELECT id FROM `users2` WHERE `username`='$username' OR `email`='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "Użytkownik o podanej nazwie lub adresie e-mail już istnieje.";
        } else {
            // dodaje użytkownika do bazy danych
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_sql = "INSERT INTO `users2` (`username`, `password`, `email`) VALUES ('$username', '$hashed_password', '$email')";

            if (mysqli_query($conn, $insert_sql)) {
                echo "Nowy użytkownik został dodany do bazy danych!";
            } else {
                echo "Błąd: " . mysqli_error($conn);
            }
        }

        mysqli_close($conn);
    }
}
?>