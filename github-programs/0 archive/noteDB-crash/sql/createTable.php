<?php
function createTable($table){
	$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {
		$sqlTable = "CREATE TABLE " . $table . " (
		note_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		title TEXT,
		txt TEXT,
        date VARCHAR(256),
        sort_nr INT(6) UNSIGNED
        )";

		$resQuery = $conn->query($sqlTable);
		if ($resQuery === TRUE){
 
		}else {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sqlIds = "CREATE TABLE " . $GLOBALS['beforeIds'] . $table . "(
		tag_id INT(8) UNSIGNED,
		note_id INT(8) UNSIGNED
		)";

		$resQuery = $conn->query($sqlIds);
		if ($resQuery === TRUE){
 
		}else {
			die("Connection failed: " . $conn->connect_error);
		}

		$sqlTags = "CREATE TABLE " . $GLOBALS['beforeTags'] . $table . " (
		tag_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		tag VARCHAR(128)
		)";

		$resQuery = $conn->query($sqlTags);
		if ($resQuery === TRUE){

		}else {
            die("Connection failed: " . $conn->connect_error);
		}		
	}

	$conn->close();
}
?>
