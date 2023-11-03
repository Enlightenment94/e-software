<?php
//https://stackoverflow.com/questions/38842072/how-can-i-setup-xampp-for-smtp-outgoing-email-on-a-unix-machine
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$header = "Header";
$to = 'enlightenmentsoftware@gmail.com';

$subject = "Wiadomość tekstowa";
$message = "Witaj to wiadomość testowa";

if(mail($to, $subject, $message, $header)){
   echo "Poprawnie wysłano e-mail";
}
else{
   echo "Wystąpił nieoczekiwany błąd, spróbuj jeszcze raz...";
}
?>
