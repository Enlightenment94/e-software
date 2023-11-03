<?php
function selectAll(){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select * from " . $GLOBALS['gNoteTable'];
        $arr = array();
        $temp = "";
	    $res = $conn->query($sql);
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $temp = array($row['note_id'], $row['note'], $row['otxt'], $row['date']);
                array_push($arr, $temp);
            }
	    }else {
		    //die("SelectAll Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
    return $arr;
}
?>

