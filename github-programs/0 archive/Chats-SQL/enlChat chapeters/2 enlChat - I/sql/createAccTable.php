<?php
function createAccTable(){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "CREATE TABLE " . $GLOBALS['usersTable'] . " (
		user_id int(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username varchar(16),
        password char(40) not null,
        friend_table_name char(40)
        )";

	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }

	    $sql = "CREATE TABLE " . $GLOBALS['accessChatsTable'] . " (
        chat_table_name char(40),
        user_id int(8)
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
