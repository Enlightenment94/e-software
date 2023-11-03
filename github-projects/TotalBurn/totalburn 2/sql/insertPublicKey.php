<?php
function insertPublicKey($userId, $publicKey){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "insert into " . $GLOBALS['gPublicKeyTables'] . " (user_id, public_key) values ('". $userId ."','" . $publicKey. "')"; 
        //echo $sql . "</br>";
	    $res = $conn->query($sql);
	    if($res === TRUE){
    
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
    }
    $conn->close();
}
?>