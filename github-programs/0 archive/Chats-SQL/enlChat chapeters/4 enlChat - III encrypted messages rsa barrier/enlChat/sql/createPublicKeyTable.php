<?php
function createPublicKeyTable(){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "CREATE TABLE " . $GLOBALS['publicKeyTables'] . " (
		user_id int(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        public_key blob(276)
        )";

	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
    }
    $conn->close();
}
?>
