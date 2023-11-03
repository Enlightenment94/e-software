<?php
function createChat($userIdA, $userIdB, $chatNameA, $chatNameB){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "CREATE TABLE " . $chatNameA . " (  
                msg_id int(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                user_id int(8),
                message blob(512),
                flag char(10),
                read_time char(64),
                destruct_time char(64),
                burn_time char(64)
                )";

        echo $sql ."</br>";
	    $res = $conn->query($sql);
	    if($res === TRUE){
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }

        $sql = "CREATE TABLE " . $chatNameB . " (   
                msg_id int(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id int(8),
                message blob(512),
                flag char(10),
                read_time char(64),
                destruct_time char(64),
                burn_time char(64)
                )";

        echo $sql ."</br>";
	    $res = $conn->query($sql);
	    if($res === TRUE){
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }

        $myChatsA = "";
	    $sql = "select my_chats from " . $GLOBALS['gUsersTable'] . " where user_id='" . $userIdA . "'";

        echo $sql . "</br>";
	    $res = $conn->query($sql);
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $myChatsA = $row['my_chats'];
            }
	    }else {
		    die(" AAA Connection failed: " . $conn->connect_error);
	    }

        $myChatsB = "";
	    $sql = "select my_chats from " . $GLOBALS['gUsersTable'] . " where user_id='" . $userIdB . "'";

        echo $sql . "</br>";
	    $res = $conn->query($sql);
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $myChatsB = $row['my_chats'];
            }
	    }else {
		    die("BB Connection failed: " . $conn->connect_error);
	    }		

        $sql = "insert into " . $myChatsA . " (point_A, point_B, user_id) values ('". $chatNameA . "','" . $chatNameB . "','" . $userIdB. "')";

        echo $sql . "</br>";
	    $res = $conn->query($sql);
	    if($res === TRUE){
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
        
        $sql = "insert into " . $myChatsB . " (point_A, point_B, user_id) values ('". $chatNameB . "','" . $chatNameA . "','" . $userIdA. "')";

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

