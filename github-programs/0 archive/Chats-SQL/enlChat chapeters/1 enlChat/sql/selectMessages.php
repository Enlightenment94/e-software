<?php
function selectMessages($chatTableName){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select user_id, message from " . $chatTableName;
	    $res = $conn->query($sql);
        $messagesArr = array();
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $arr = array($row['user_id'], $row['message']);
                array_push($messagesArr, $arr);
            }                
	    }else {
            return "";
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
    return $messagesArr;
}
?>

