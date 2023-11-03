<?php
function selectTablenames(){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
        $tablesArr = array();
	    $sql = "show tables";
	    $res = $conn->query($sql);
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                array_push($tablesArr, $row['Tables_in_' . $GLOBALS['gDbname'] ]);
            }
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
    }
    $conn->close();
    return $tablesArr;
}
?>