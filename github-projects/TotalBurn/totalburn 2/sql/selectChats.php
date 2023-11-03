<?php
function selectChats($myChats){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select point_A from " . $myChats . ";";
	    $res = $conn->query($sql);
        $arr = array();
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                array_push($arr, $row['point_A']);
            }
	    }else {
		    //die("selectChats - Connection failed: " . $conn->connect_error);
            return 0;
	    }		
    }
    $conn->close();
    return $arr;
}
?>