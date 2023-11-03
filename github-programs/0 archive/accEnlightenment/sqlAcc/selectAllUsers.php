<?php
function selectAllUsers(){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select * from " . $GLOBALS['accTable'];
	    $res = $conn->query($sql);
        $recArrUsers = array();
        $temp;
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $temp = new User($row['user_id'], $row['login']);
                array_push($recArrUsers, $temp);
            }
	    }else {
            $conn->close();
	    }		
    }
    $conn->close();
    return $recArrUsers;
}
?>

