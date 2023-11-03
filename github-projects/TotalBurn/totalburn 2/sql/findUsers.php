<?php
function findUsers($str){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "SELECT username FROM " . $GLOBALS['gUsersTable'] . " WHERE username LIKE '%" . $str. "%';";
	    $res = $conn->query($sql);
        $usersArr = array();
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                array_push($usersArr, $row['username']);
            }                
	    }else {
		    die("findUsers Connection failed: " . $conn->connect_error);
	    }
    }
    $conn->close();
    return $usersArr;
}
?>