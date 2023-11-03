<?php
function selectStacks(){
	$conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {
		$sql = "select * from " . $GLOBALS['gStacksTable'];
		$resQuery = $conn->query($sql);
	    $res = $conn->query($sql);
        $arr = array();
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                array_push($arr, $row['stack']);
            }
	    }else {
			die("Connection failed: " . $conn->connect_error);
		}
	}
	$conn->close();
    return $arr;
}
?>
