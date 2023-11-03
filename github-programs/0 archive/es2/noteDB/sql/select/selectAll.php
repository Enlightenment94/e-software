<?php
function selectAll(){
    $arr = array();
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select * from " . $GLOBALS['table'];

	    $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $obj = new Note($row['note_id'], $row['note'], $row['author'], $row['otxt'], $row['date']);
                array_push($arr, $obj);
            }
	    }else {
		    //die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
    return $arr;
}
?>

