<?php
function readMsg($chatName, $msgId){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select destruct_time from " . $chatName . " where msg_id='". $msgId ."'";; 
        $destructTime =  "";

	    $res = $conn->query($sql);
		if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $destructTime = $row['destruct_time'];
                break;
            }
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
       
        
        $readTime = addTime($destructTime);
	    $sql = "update " . $chatName . " set read_time='" . $readTime . "' where msg_id='". $msgId ."'";; 
	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
}
?>