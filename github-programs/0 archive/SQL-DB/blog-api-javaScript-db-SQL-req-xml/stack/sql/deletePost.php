<?php
function deletePost($postId){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "delete from " . $GLOBALS['gPosts'] . " where post_id='" . $postId . "'";
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

