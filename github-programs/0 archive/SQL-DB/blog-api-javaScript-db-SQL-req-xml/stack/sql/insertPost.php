<?php
function insertPost($header, $post){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "insert into " . $GLOBALS['gPosts']. " (header, post, date) values ('". $conn->real_escape_string($header) . "','" . $conn->real_escape_string($post) . "','". date("d-m-y h:i:s") ."')";
        echo $sql;
	    $res = $conn->query($sql);
	    if($res === TRUE){
	    }else {
		    die("insertPost Connection failed: " . $conn->connect_error);
	    }
    }
    $conn->close();
}
?>

