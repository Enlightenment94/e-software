<?php
function selectAll(){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select * from " . $GLOBALS['gPosts'] ;

        $arr = array();
	    $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $tempArr = array($row['post_id'], $row['header'],  $row['post'], $row['date']);
                array_push($arr, $tempArr);
            }
	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }	
    }
    $conn->close();
    return $arr;
}
?>

