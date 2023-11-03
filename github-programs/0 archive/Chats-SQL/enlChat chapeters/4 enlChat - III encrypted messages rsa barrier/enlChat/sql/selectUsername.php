<?php
function selectUsername($user_id){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select username from " . $GLOBALS['usersTable'] . " where user_id='" . $user_id . "'";
	    $res = $conn->query($sql);
        $username = "";
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $username = $row['username'];
                return $username;
            }                
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
    return $id;
}
?>

