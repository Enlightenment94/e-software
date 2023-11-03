<?php
//https://stackoverflow.com/questions/38842072/how-can-i-setup-xampp-for-smtp-outgoing-email-on-a-unix-machine
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Multiple recipients
$to = 'enlightenmentsoftware@gmail.com';

// Subject
$subject = 'Hello mail';

// Message
$message = 'Hello mail php';

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Additional headers
$headers[] = 'To: <enlightenmentsoftware@gmail.com>';
$headers[] = 'From: Example <nobody@example.com>';
$headers[] = 'Cc: nobodyarchive@example.com'; //??
$headers[] = 'Bcc: nobodycheck@example.com'; //??

// Mail IT
if(mail($to, $subject, $message, implode("\r\n", $headers))){
    echo "Wysłano";
}else{
    echo "Błąd wysyłania";
}
?>
