<?php
function createTable($tableName){
	$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {
		$sql = "CREATE TABLE " . $tableName . " (
		note_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		note TEXT,
        author VARCHAR(128), 
		otxt TEXT,
        date VARCHAR(256)
        )";

        
		$resQuery = $conn->query($sql);
		if ($resQuery === TRUE){
 
		}else {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = "CREATE TABLE " . $GLOBALS['beforeIds'] . $tableName . "(
		tag_id INT(8) UNSIGNED,
		note_id INT(8) UNSIGNED
		)";

		$resQuery = $conn->query($sql);
		if ($resQuery === TRUE){
 
		}else {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "CREATE TABLE " . $GLOBALS['beforeTags'] . $tableName . " (
		tag_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		tag VARCHAR(128)
		)";

		$resQuery = $conn->query($sql);
		if ($resQuery === TRUE){

		}else {
            die("Connection failed: " . $conn->connect_error);
		}		
	}

	$conn->close();
}
?>
