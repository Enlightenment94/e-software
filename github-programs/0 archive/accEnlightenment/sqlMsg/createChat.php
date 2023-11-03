<?php
function createChat($tableName){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "CREATE TABLE " . $tableName . " (
		userA_id int(8) UNSIGNED,
        userB_id int(8) UNSIGNED,
        messages text,
        whose int(8) UNSIGNED
        )";

	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
}
?>
