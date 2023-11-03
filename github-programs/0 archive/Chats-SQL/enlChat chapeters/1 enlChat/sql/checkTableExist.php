<?php
function checkTableExist($tableName){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "SELECT * 
                FROM information_schema.tables
                WHERE table_schema = '" . $GLOBALS['dbname'] . "' 
                    AND table_name = '" . $tableName . "' LIMIT 1;";
	    $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                if($row['TABLE_NAME']){
                    return 1;
                }
            }                
	    }else {
            return "0";
		    die("Connection failed: " . $conn->connect_error);
	    }
    }
    $conn->close();
    return "0";
}
?>
