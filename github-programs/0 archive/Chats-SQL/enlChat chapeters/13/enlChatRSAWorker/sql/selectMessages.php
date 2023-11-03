<?php
function selectMessages($chatTableName){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select msg_id, user_id, message, destruct_time from " . $chatTableName . ";";
	    $res = $conn->query($sql);
        $arr = array();
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $arr2 = array($row['user_id'], $row['message'],  $row['destruct_time'], $row['msg_id']);
                array_push($arr, $arr2);
            }
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
    return $arr;
}
?>

