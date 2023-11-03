<?php
session_start(); //  rozpoczyna sesję
require_once("../form/static.php");
require_once('../php/validate.php');

if(isset($_POST['captcha'])){
    $captcha = $_POST['captcha'];
    if($captcha == $_SESSION['captcha']){
        echo "You are human.";
    }else{
        echo "You are not human, mistake or low IQ people.";
        die();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') { // sprawdza, czy formularz został wysłany metodą POST

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // pobiera dane z formularza i wykonuje zapytanie do bazy danych
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = encodeSpecialChars($username);
        $password = encodeSpecialChars($password);

        $sql = "SELECT * FROM `users2` WHERE `username` = '$username'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // sprawdza, czy hasło jest poprawne
            if(password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                $randomString = rand(1000000000000000, 9999999999999999);
                $_SESSION['id'] = $randomString; 
                //header('Location: dashboard.php'); 
                echo "<script>window.location.href='../app/dashboard.php';</script>";
                exit;
            } else {
                $error_message = "Nieprawidłowe hasło. Spróbuj ponownie.";
            }
        } else {
            $error_message = "Nieprawidłowa nazwa użytkownika. Spróbuj ponownie.";
        }
    }
}
?>