<?php
function selectChatsPointB($myChats){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select point_B from " . $myChats . ";";
	    $res = $conn->query($sql);
        $arr = array();
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                array_push($arr, $row['point_B']);
            }
	    }else {
		    //die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
    return $arr;
}
?>