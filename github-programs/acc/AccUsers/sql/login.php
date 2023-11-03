<?php
function login($user, $pass){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select login, password from " . $GLOBALS['accTable'];
	    $res = $conn->query($sql);
        $login = "";
        $pass = "";
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                if(($login = $row['login']) && ($pass == $row['pass'])){
                    return 1;
                }
            }
	    }else {
            $conn->close();
            return 2;
	    }		
    }
    $conn->close();
    return 0;
}
?>

