<?php
function dropStack($stack){
	$conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {
		$sql = "delete from " . $GLOBALS['gStacksTable'] . " where stack='". $stack ."'";
	    $res = $conn->query($sql);
        if ($res === "TRUE") {
	    }else {
			//die("Connection failed: " . $conn->connect_error);
		}

		$sql = "drop table " . $stack;
	    $res = $conn->query($sql);
        if ($res === "TRUE") {
	    }else {
			//die("Connection failed: " . $conn->connect_error);
		}

		$sql = "drop table ids_" . $stack;
	    $res = $conn->query($sql);
        if ($res === "TRUE") {
	    }else {
			//die("Connection failed: " . $conn->connect_error);
		}

		$sql = "drop table tags_" . $stack;
	    $res = $conn->query($sql);
        if ($res === "TRUE") {
	    }else {
			//die("Connection failed: " . $conn->connect_error);
		}

	}

	$conn->close();
}
?>
