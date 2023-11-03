<?php
function sendMessage($user_id, $pointA, $messageMyPublicKey, $messageReciverPublicKey, $burnTime, $destructTime){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
        $myChats = "";
	    $sql = "select my_chats from " . $GLOBALS['gUsersTable'] . " where user_id='" . $user_id . "'";
	    $res = $conn->query($sql);
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $myChats = $row['my_chats'];
            }
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }

        $pointB = "";
	    $sql = "select point_B from " . $myChats . " where point_a='" . $pointA . "'";
	    $res = $conn->query($sql);
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $pointB = $row['point_B'];
            }
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
        
        $burn = addTime($burnTime);
	    $sql = "insert into " . $pointA . "(user_id, message, flag, burn_time, destruct_time) values ('" . $user_id . "','" . $messageMyPublicKey . "','" . $user_id . "my_pub" . "','" . $burn . "','" . $destructTime. "')";
	    $res = $conn->query($sql);
	    if($res === TRUE){
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
        
	    $sql = "insert into " . $pointB . "(user_id, message, flag, burn_time, destruct_time) values ('" . $user_id . "','" . $messageReciverPublicKey . "','" . $user_id . "rec_pub" . "','" . $burn . "','" . $destructTime. "')";
	    $res = $conn->query($sql);
	    if($res === TRUE){
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
}
?>