<?php
function checkUserExist($isUserExist){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select * from " . $GLOBALS['accTable'];
	    $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                if($isUserExist === $row['login']){
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

