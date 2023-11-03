<?php
function selectById($id){
    $ret = null;
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select * from " . $GLOBALS['table'] . " where afo_id='" . $id . "'";

	    $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $obj = new Afo($row['afo_id'], $row['afo'], $row['author'], $row['otxt'], $row['date']);
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

