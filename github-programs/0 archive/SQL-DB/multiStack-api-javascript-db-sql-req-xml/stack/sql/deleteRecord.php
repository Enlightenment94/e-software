<?php
function deleteRecord($noteId){
	$conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {
		$sql = "delete from " . $GLOBALS['gNoteTable'] . " where note_id='" . $noteId . "'";
         
	    $res = $conn->query($sql);
        if ($res === TRUE) {
	    }else {
			die("Connection failed: " . $conn->connect_error);
		}
	}

	$conn->close();
}
?>
