<?php
function createAccTable($tableName){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "CREATE TABLE " . $tableName . " (
		user_id int(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        login varchar(16),
        password char(40) not null,
        email varchar(100) not null
        )";

	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }

        $sql = "CREATE TABLE " . "reg_" . $tableName . " (
		user_id int(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        login varchar(16),
        password char(40) not null,
        email varchar(100) not null,
		reg int(8)
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
