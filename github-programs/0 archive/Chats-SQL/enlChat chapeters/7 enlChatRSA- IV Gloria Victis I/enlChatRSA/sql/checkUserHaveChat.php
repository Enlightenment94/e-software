<?php
function checkUserHaveChat($myChats, $point){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select point_B from " . $myChats . " where point_B='" . $point . "';";
	    $res = $conn->query($sql);
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                if($point == $row['point_B']){
                    return "1";
                }
            }
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
    return "0";
}
?>

