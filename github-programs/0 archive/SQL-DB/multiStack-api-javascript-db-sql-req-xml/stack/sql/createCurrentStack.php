<?php
function create($tableName){
	$conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {
		$sql = "CREATE TABLE " . $tableName . " (
		note_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		note TEXT, 
		otxt TEXT,
        date VARCHAR(256)
        )";
        
		$resQuery = $conn->query($sql);
		if ($resQuery === TRUE){
 
		}else {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = "CREATE TABLE " . "ids_" . $tableName . "(
		tag_id INT(8) UNSIGNED,
		note_id INT(8) UNSIGNED
		)";

		$resQuery = $conn->query($sql);
		if ($resQuery === TRUE){
 
		}else {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "CREATE TABLE " . "tags_" . $tableName . " (
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
