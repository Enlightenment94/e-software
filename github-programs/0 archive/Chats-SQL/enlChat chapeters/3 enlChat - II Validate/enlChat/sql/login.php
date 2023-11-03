<?php
function login($user, $pass){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select username, password from " . $GLOBALS['usersTable'] . " where username='" . $user . "'" . " and password='". $pass . "'";
	    $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                if($user == $row['username'] && $pass == $row['password']){
                    return "1";
                }
            }                
	    }else {
            return 0;
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
    return "0";
}
?>

