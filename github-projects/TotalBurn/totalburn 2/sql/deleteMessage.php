<?php
function deleteMessage($messageSenderId, $messageReciverId, $chatSender, $chatReciver){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "delete from " . $chatSender . " where msg_id='" . $messageSenderId . "'";
	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }

	    $sql = "delete from " . $chatReciver . " where msg_id='" . $messageReciverId . "'";
	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
    }
    $conn->close();
}
?>