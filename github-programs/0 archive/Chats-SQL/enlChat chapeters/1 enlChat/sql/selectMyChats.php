<?php
function selectMyChats($user_id){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select chat_table_name from " . $GLOBALS['accessChatsTable'] . " where user_id='" .  $user_id . "'";
        $chatsArr = array();

	    $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                array_push($chatsArr, $row['chat_table_name']); 
            }                
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
    }
    $conn->close();
    return $chatsArr;
}
?>
