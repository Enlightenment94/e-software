<?php
function checkUsernameExist($username){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select username from " . $GLOBALS['gUsersTable'] . " where username='" . $username . "'";
	    $res = $conn->query($sql);
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                if($row['username'] = $username){
                    return 1;
                }
            }
	    }else {
		    //die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
    return 0;
}
?>

