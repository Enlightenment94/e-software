<?php
function deleteTag($dtg){
    $n = count($dtg);
	$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {        
        $bytg = array();
        $sql = "SELECT tag_id FROM " . $GLOBALS['beforeTags'] . $GLOBALS['table'] . " WHERE ";  
        $m = count($dtg);
        for($i = 0 ; $i < $m - 1; $i++){
            if($dtg == ""){
                break;
            }
            $sql .= " tag='" . $dtg[$i] . "' or";
        }
        $sql .= " tag='" . $dtg[$m - 1] . "'";

        
        echo $sql . "</br>";

		$res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                array_push($bytg, $row['tag_id']);
            }
	    }else {
            die("Connection failed select: " . $conn->connect_error);
	    }

        for($i = 0; $i < $n; $i++){
		    $sql = "DELETE FROM " . $GLOBALS['beforeTags'] . $GLOBALS['table'] . " WHERE tag='" . $dtg[$i] .  "'";
		    $resQuery = $conn->query($sql);

		    if ($resQuery === TRUE){
            
		    }else {
			    die("Connection failed: " . $conn->connect_error);
		    }
        }

        for($i = 0; $i < $n; $i++){
		    $sql = "DELETE FROM " . $GLOBALS['beforeIds'] . $GLOBALS['table'] . " WHERE tag_id='" . $bytg[$i] .  "'";
		    $resQuery = $conn->query($sql);         
		    if ($resQuery === TRUE){
                
		    }else {
			    die("Connection failed: " . $conn->connect_error);
		    }
        }
	}
	$conn->close();
}
?>
