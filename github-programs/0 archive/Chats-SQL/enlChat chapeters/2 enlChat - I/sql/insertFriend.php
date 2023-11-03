<?php
function insertFriend($friendsTableName, $user_id){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
        $sql = "insert into " . $friendsTableName . " (friend_id) values ('". $user_id ."') ";
	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
        
    }
    $conn->close();
}
?>
