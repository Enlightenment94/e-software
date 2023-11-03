<?php
function selectPublicKey($userId){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select public_key from " . $GLOBALS['gPublicKeyTables'] . " where user_id='" . $userId ."'";
	    $res = $conn->query($sql);
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                return $row['public_key'];
            }
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
}
?>

