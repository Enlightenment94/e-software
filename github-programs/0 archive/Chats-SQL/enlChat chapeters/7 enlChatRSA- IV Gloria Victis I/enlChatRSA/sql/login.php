<?php
function login($username, $password){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select username, password from " . $GLOBALS['gUsersTable'] . " where username='" . $username . "' and password='" .  $password . "'";
	    $res = $conn->query($sql);
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                if ($row['username'] == $username && $row['password'] == $password){
                    return 1;
                }
            }
	    }else {
            return 0;
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
    return 0;
}
?>

