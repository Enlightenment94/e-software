<?php
// załadowanie pliku wp-load.php
require_once 'wp-load.php';

// pobranie listy użytkowników
$users = get_users();

// wyświetlenie listy użytkowników
if (!empty($users)) {
    echo '<ul>';
    foreach ($users as $user) {
        echo '<li>' . $user->ID . " " . $user->display_name . ' (' . $user->user_email . ')</li>';
    }
    echo '</ul>';
} else {
    echo 'Nie znaleziono użytkowników.';
}
?>