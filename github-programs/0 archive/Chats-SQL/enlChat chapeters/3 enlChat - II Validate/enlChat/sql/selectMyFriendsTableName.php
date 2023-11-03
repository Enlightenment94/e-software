<?php
function selectMyFriendsTableName($user_id){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select friend_table_name from " . $GLOBALS['usersTable'] . " where user_id='" . $user_id . "'";
	    $res = $conn->query($sql);
        $friendTableName = "";
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $friendTableName = $row['friend_table_name'];
                return $friendTableName;
            }                
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
}
?>

