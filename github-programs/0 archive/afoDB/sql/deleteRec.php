<?php
function deleteRec($dby){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {        
		$sql = "DELETE FROM " . $GLOBALS['table'] . " WHERE afo_id='" . $dby .  "'";
		$resQuery = $conn->query($sql);
		if ($resQuery === TRUE){
            
		}else {
	        die("Connection failed: " . $conn->connect_error);
		}

	    $sql = "DELETE FROM " . $GLOBALS['beforeIds'] . $GLOBALS['table'] . " WHERE afo_id='" . $dby .  "'";
		$resQuery = $conn->query($sql);            
        if ($resQuery === TRUE){
                
        }else {
            die("Connection failed: " . $conn->connect_error);
		}
	}

	$conn->close();
}
?>
