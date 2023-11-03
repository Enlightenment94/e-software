<?php
function insertPublicKey($user_id, $publicKey){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
        $sql = "insert into " . $GLOBALS['publicKeyTables'] . " (user_id, public_key) values ('". $user_id. "','". $publicKey . "')";
	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
    }
    $conn->close();
}
?>
