<?php
function selectTags(){
	$conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {
		$sql = "select * from " . $GLOBALS['gTagsTable'];
		$resQuery = $conn->query($sql);
	    $res = $conn->query($sql);
        $arr = array();
        $tempArr = "";
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $tempArr = array($row['tag_id'], $row['tag']);
                array_push($arr, $tempArr);
            }
	    }else {
			die("Connection failed: " . $conn->connect_error);
		}
	}
	$conn->close();
    return $arr;
}
?>
