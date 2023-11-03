<?php
function createTable(){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "CREATE TABLE " . $GLOBALS['gPosts'] . " (
		        post_id int(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                header char(255),
                post TEXT,
                date VARCHAR(32)
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

