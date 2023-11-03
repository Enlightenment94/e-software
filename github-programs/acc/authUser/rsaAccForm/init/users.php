<?php
require_once('../form/static.php');

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM `users2`";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // wyświetla tabelę z użytkownikami
    echo "<table>";
    echo "<tr><th>ID</th><th>Nazwa użytkownika</th><th>Adres e-mail</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Brak zarejestrowanych użytkowników.";
}

mysqli_close($conn);
?>