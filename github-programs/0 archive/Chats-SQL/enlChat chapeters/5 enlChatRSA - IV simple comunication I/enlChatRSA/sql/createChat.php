<?php
function createChat($userIdA, $userIdB, $chatNameA, $chatNameB){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "CREATE TABLE " . $chatNameA . " (   
                user_id int(8),
                message blob(512),
                flag char(10)
                )";

        echo $sql ."</br>";
	    $res = $conn->query($sql);
	    if($res === TRUE){
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }

        $sql = "CREATE TABLE " . $chatNameB . " (   
                user_id int(8),
                message blob(512),
                flag char(10)
                )";

        echo $sql ."</br>";
	    $res = $conn->query($sql);
	    if($res === TRUE){
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }

        $myChatsA = "";
	    $sql = "select my_chats from " . $GLOBALS['gUsersTable'] . " where user_id='" . $userIdA . "'";

	    $res = $conn->query($sql);
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $myChatsA = $row['my_chats'];
            }
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }

        $myChatsB = "";
	    $sql = "select my_chats from " . $GLOBALS['gUsersTable'] . " where user_id='" . $userIdB . "'";

	    $res = $conn->query($sql);
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $myChatsB = $row['my_chats'];
            }
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }		

        $sql = "insert into " . $myChatsA . " (point_A, point_B) values ('". $chatNameA . "','" . $chatNameB . "')";

        echo $sql . "</br>";
	    $res = $conn->query($sql);
	    if($res === TRUE){
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
        
        $sql = "insert into " . $myChatsB . " (point_A, point_B) values ('". $chatNameB . "','" . $chatNameA . "')";

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

