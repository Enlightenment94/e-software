<?php
function insertUser($user, $pass){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
        $friendTableName = generateRandomString();
        $sql = "insert into " . $GLOBALS['usersTable'] . " (username, password, friend_table_name) values ('". $user. "','". $pass ."','" . $friendTableName . "')";

        echo $sql;
	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }

        $sql = "create table " . $friendTableName . "(
    	friend_id int(8)
        )";
	    $res = $conn->query($sql);
	    if($res === TRUE){

	    }else {
		    die("Connection failed: " . $conn->connect_error);
	    }
        
    }
    $conn->close();
}
?>
