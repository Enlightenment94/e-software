<?php
function createTable(){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "CREATE TABLE " . $GLOBALS['gUsersTable'] . " (
		        user_id int(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username varchar(16),
                password char(40) not null,
                my_chats char(40)
            )";

        echo $sql . "</br>";
	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }

        $sql = "CREATE TABLE " . $GLOBALS['gPublicKeyTables'] . " (
		        user_id int(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                public_key BLOB(512)
                )";

        echo $sql . "</br>";
	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
}
?>