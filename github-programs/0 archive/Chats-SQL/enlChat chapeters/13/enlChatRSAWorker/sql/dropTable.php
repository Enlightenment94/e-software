<?php
function dropTable($tableName){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
        $sql = "drop table " . $tableName;
	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    //die("Connection failed: " . $conn->connect_error);
	    }
    }
    $conn->close();
}
?>

