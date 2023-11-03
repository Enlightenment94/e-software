<?php
function insertNotVerifyUser($login, $pass, $email, $randValue){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "insert into " . $GLOBALS['accTableReg'] . "(login, password, email, reg) values ('" . $login . "','" . $pass . "','" . $email . "','" . $randValue . "')";
	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
        //select last

        $sqlLastId = "select LAST_INSERT_ID()";
        $lastId = "";
        $resQuery = $conn->query($sqlLastId);
        if ($resQuery->num_rows > 0) {
	        while($row = $resQuery->fetch_assoc()) {
                	$lastId = $row['LAST_INSERT_ID()'];
                    return $lastId;
	        } 
        }else {
	        die("Connection failed2: " . $conn->connect_error);
        }
    }
    $conn->close();
    //return null;
}
?>
