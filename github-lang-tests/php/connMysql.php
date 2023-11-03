<?php
$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}else {
	$sql = "SHOW TABLES";

	$res = $conn->query($sql);
	if($res === TRUE){
		if ($res->num_rows > 0) {
        		while($row = $res->fetch_assoc()) {
                        }
		}
	}else {
		die("Connection failed: " . $conn->connect_error);
	}		
}
$conn->close();
?>