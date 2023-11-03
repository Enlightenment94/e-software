<?php
function countChats($myChats, $userId){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select count(user_id) as n from " . $myChats . " where user_id='" . $userId . "';";
	    $res = $conn->query($sql);
        $howMany = 0;
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $howMany = $row['n'];
                return $howMany;
            }
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
    return $arr;
}
?>

