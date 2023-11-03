<?php
function updatePost($postId, $header, $post){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "update " . $GLOBALS['gPosts']. " set header='" . $conn->real_escape_string($header) ."', post='". $conn->real_escape_string($post) ."' where post_id='" . $postId . "'";
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

