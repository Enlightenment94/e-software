<?php
function insertTag($tag){
	$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {
		$sqlInsertTag = "insert into " . $GLOBALS['beforeTags'] .  $GLOBALS['table'] . " (tag) values ('" . $tag . "')";

		$resQuery = $conn->query($sqlInsertTag);
		if ($resQuery === TRUE){
 
		}else {
			die("Connection failed: " . $conn->connect_error);
		}
	}

	$conn->close();
}
?>
