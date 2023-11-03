<?php
$dbhost = 'localhost'; // nazwa hosta
$dbuser = 'homeandk_4home'; // nazwa użytkownika bazy danych
$dbpass = 'C,HD$.$lWa[C'; // hasło użytkownika bazy danych

// połączenie z bazą danych
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

// pobranie listy baz danych
$result = mysqli_query($conn, 'SHOW DATABASES');

// wyświetlenie listy baz danych
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['Database'] . '<br>';
}

// zamknięcie połączenia z bazą danych
mysqli_close($conn);
?>