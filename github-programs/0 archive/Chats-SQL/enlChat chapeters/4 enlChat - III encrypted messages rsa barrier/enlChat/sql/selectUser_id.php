<?php
function selectUser_id($username){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select user_id from " . $GLOBALS['usersTable'] . " where username='" . $username . "'";
	    $res = $conn->query($sql);
        $id = "";
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $id = $row['user_id'];
                return $id;
            }                
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
    return $id;
}
?>

