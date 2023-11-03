<?php
function addVerifyUser($user_id){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
        $login = "";
        $pass = "";
        $email = "";
	    $sql = "select user_id, email, login, password from " .$GLOBALS['accTableReg'];
	    $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $login = $row['login'];
                $pass = $row['password'];
                $email = $row['email'];
            }
	    }else {
    	    die("Connection failed: " . $conn->connect_error);
	    }		

	    $sql = "insert into " . $GLOBALS['accTable'] . " (login, password, email) values ('" . $login . "','" . $pass . "','" . $email .  "')";
	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }

        $sql = "delete from " . $GLOBALS['accTableReg'] . " where user_id='" . $user_id . "'";
        $resQuery = $conn->query($sql);
	    if($res === TRUE){

        }else {
	        die("Connection failed2: " . $conn->connect_error);
        }
    }
    $conn->close();
    return null;
}
?>
