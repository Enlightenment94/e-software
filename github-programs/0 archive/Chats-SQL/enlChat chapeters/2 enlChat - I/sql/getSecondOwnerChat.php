<?php
function getSecondOwnerChat($user_idFirstOwner, $chatTableName){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select user_id from " . $GLOBALS['accessChatsTable'] . " where user_id!='" . $user_idFirstOwner . "' and chat_table_name='". $chatTableName . "'";
	    $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                return $row['user_id'];
            }                
	    }else {
            return "0";
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
    return "0";
}
?>

