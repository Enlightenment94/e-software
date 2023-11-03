<?php
// ustawienia bazy danych
$host = 'localhost';
$username = 'homeandk_land';
$password = '9Yu-;;.U(Jkr';
$database = 'homeandk_land';

// nazwa pliku eksportu
$backup_file = 'db.sql';

// utworzenie połączenia z bazą danych
$conn = new mysqli($host, $username, $password, $database);

// sprawdzenie poprawności połączenia
if($conn->connect_error){
  die("Połączenie nieudane: " . $conn->connect_error);
}

// pobranie listy tabel z bazy danych
$result = $conn->query("SHOW TABLES");

// pobranie nazw tabel i utworzenie tablicy
$tables = array();
while($row = $result->fetch_array()){
  $tables[] = $row[0];
}

foreach($tables as $table){
  $result = $conn->query("SHOW CREATE TABLE $table");
  $row = $result->fetch_row();
  $table_def = $row[1];
  
  file_put_contents($backup_file, $table_def . ";\n\n", FILE_APPEND);

  $result = $conn->query("SELECT * FROM $table");

  while($row = $result->fetch_assoc()){
    $columns = array();
    foreach($row as $key => $value){
      $columns[] = "$key='" . addslashes($value) . "'";
    }
    $values = implode(',', $columns);
    file_put_contents($backup_file, "INSERT INTO $table SET $values;\n", FILE_APPEND);
  }
  file_put_contents($backup_file, "\n", FILE_APPEND);
}

$conn->close();

echo "Baza danych została wyeksportowana do pliku $backup_file";
?>