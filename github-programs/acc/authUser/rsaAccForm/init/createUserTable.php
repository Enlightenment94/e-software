<?php
//https://esoftware.atwebpages.com/form/createUserTable.php
function create_user_table(){
    require_once('../form/static.php');

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // tworzy tabelę użytkowników
    $sql = "CREATE TABLE `users2` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`),
    UNIQUE KEY `email` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if (mysqli_query($conn, $sql)) {
        echo "Tabela `users2` została utworzona!";
    } else {
        echo "Błąd podczas tworzenia tabeli: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

create_user_table();
?>