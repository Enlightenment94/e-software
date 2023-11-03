<?php
function selectOne($id){
    $ret = null;
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select * from " . $GLOBALS['table'] . " where note_id='" . $id . "'";

	    $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $obj = new Record($row['note_id'], $row['title'], $row['txt'], $row['date'], $row['sort_nr']);
                $ret = $obj;
            }
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
    return $ret;
}
?>

