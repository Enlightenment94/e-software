<?php
function insertUser($username, $password, $myChats){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "insert into " . $GLOBALS['gUsersTable'] . "(username, password, my_chats) values ('" . $username . "','" . $password . "','" . $myChats . "')"; 
        
        //echo $sql . "</br>";
	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }

	    $sql = "create table " .  $myChats . " (
                point_A char(40),
                point_B char(40),
                user_id int(8)"
                . ")";
                
        //echo $sql . "</br>";
	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }		
    }
    $conn->close();
}
?>