<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('wp-load.php');

$new_password = 'abcd!'; 

$user_id = 1;

if ( $user_id ) {
    wp_set_password( $new_password, $user_id ); // zmiana hasła
    echo 'Hasło dla użytkownika "golger" zostało zmienione.';
} else {
    echo 'Nie znaleziono użytkownika o nazwie "golger".';
}

?>