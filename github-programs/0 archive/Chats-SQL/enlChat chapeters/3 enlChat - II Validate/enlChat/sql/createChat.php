<?php
function createChat($chatTableName, $Auser_id, $Buser_id){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "CREATE TABLE " . $chatTableName . " (
        user_id int(8),
        message char(255) 
        )";

	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
        
	    $sql = "insert into " . $GLOBALS['accessChatsTable'] . " (chat_table_name, user_id) values ('" . $chatTableName . "', '" . $Auser_id . "')";

	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
        
        $sql = "insert into " . $GLOBALS['accessChatsTable'] . " (chat_table_name, user_id) values ('" . $chatTableName . "', '" . $Buser_id . "')";

	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }

    }
    $conn->close();
}
?>
