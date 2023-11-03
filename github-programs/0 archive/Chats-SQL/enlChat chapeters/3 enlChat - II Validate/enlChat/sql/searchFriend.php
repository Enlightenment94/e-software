<?php
function searchFriend($str){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "SELECT username FROM users WHERE username LIKE '%" . $str. "%';";
	    $res = $conn->query($sql);
        $usersArr = array();
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                array_push($usersArr, $row['username']);
            }                
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
    }
    $conn->close();
    return $usersArr;
}
?>
