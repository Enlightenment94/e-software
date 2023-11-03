<?php
function insertTag($tag){
	$conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {
		$sql = "insert into " . $GLOBALS['gTagsTable'] . " (tag) values ('". $tag . "')";
        echo $sql;
		$resQuery = $conn->query($sql);
		if ($resQuery === TRUE){
 
		}else {
			die("aaaaaaaaaaaaaa Connection failed: " . $conn->connect_error);
		}
	}

	$conn->close();
}
?>
