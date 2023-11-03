<?php
function insertStack($stack){
	$conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {
		$sql = "insert into " . $GLOBALS['gStacksTable'] . " (stack) values ('". $stack. "')";
		$resQuery = $conn->query($sql);
		if ($resQuery === TRUE){
 
		}else {
			die("Connection failed: " . $conn->connect_error);
		}
	}

	$conn->close();
}
?>
