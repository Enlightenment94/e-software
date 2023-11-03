<?php
function selectFriends($friendsTableName){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select friend_id from " . $friendsTableName;
	    $res = $conn->query($sql);
        $friendsArr = array();
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                array_push($friendsArr, $row['friend_id']);
            }                
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
    return $friendsArr;
}
?>

