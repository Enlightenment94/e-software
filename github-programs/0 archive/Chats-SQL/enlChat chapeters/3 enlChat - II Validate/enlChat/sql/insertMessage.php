<?php
function insertMessage($chatTableName, $user_id, $message){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
    if ($conn->connect_error) {

	    die("Connection failed: " . $conn->connect_error);
    }else {
        $sql = "insert into " . $chatTableName . " (user_id, message) values ('" . $user_id . "', '" . $message . "')";
        echo $sql;
	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
        
    }
    $conn->close();
}
?>
