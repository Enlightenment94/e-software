<?php
function deleteTag($tag){
	$conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {
		$sql = "select tag_id from " . $GLOBALS['gTagsTable'] . " where tag='" . $tag . "'";
         
        $tag_id = "";
	    $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $tag_id = $row['tag_id'];
            }
	    }else {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "delete from " . $GLOBALS['gIdsTagsTable'] . " where tag_id='" . $tag_id . "'";
         
	    $res = $conn->query($sql);
        if ($res === TRUE) {

	    }else {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "delete from " . $GLOBALS['gTagsTable'] . " where tag_id='" . $tag_id . "'";
         
	    $res = $conn->query($sql);
        if ($res === TRUE) {

	    }else {
			die("Connection failed: " . $conn->connect_error);
		}
	}

	$conn->close();
}
?>
