<?php
function createTable($tableName){
	$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {
		$sqlAfoTable = "CREATE TABLE " . $tableName . " (
		afo_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		afo TEXT,
        author VARCHAR(128), 
		otxt TEXT,
        date VARCHAR(256)
        )";

		$resQuery = $conn->query($sqlAfoTable);
		if ($resQuery === TRUE){
 
		}else {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sqlAfoIdsTable = "CREATE TABLE " . $GLOBALS['beforeIds'] . $tableName . "(
		tag_id INT(8) UNSIGNED,
		afo_id INT(8) UNSIGNED
		)";

		$resQuery = $conn->query($sqlAfoIdsTable);
		if ($resQuery === TRUE){
 
		}else {
			die("Connection failed: " . $conn->connect_error);
		}

		$sqlTagsTable = "CREATE TABLE " . $GLOBALS['beforeTags'] . $tableName . " (
		tag_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		tag VARCHAR(128)
		)";

		$resQuery = $conn->query($sqlTagsTable);
		if ($resQuery === TRUE){

		}else {
            die("Connection failed: " . $conn->connect_error);
		}		
	}

	$conn->close();
}
?>
