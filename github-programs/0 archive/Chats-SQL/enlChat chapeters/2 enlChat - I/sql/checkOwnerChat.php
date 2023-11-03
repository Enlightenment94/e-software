<?php
function checkOwnerChat($user_id, $chatName){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select chat_table_name, user_id from " . $GLOBALS['accessChatsTable'] . " where user_id='" . $user_id . "' and chat_table_name='". $chatName . "'";
	    $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                if( ($chatName == $row['chat_table_name']) && ($user_id == $row['user_id']) ){
                    return "1";
                }
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

