<?php
function verify($user_id, $verifyCode){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select user_id, reg from " .$GLOBALS['accTableReg'];
	    $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                if($user_id == $row['user_id'] && $verifyCode == $row['reg']){
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

