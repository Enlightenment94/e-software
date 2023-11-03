<?php

function checkHowManyMessages($chatTableName){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select count(msg_id) as n from " . $chatTableName . ";";
	    $res = $conn->query($sql);
        $arr = array();
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                return $row['n'];
            }
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
    return $arr;
}
?>