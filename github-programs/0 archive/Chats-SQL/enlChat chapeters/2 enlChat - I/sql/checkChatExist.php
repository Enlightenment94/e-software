<?php
function checkChatExist($chatTableName){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
    }else {
	    $sql = "select chat_table_name from " . $GLOBALS['accessChatsTable'] . " where chat_table_name='" . $chatTableName . "'";
	    $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $chatTableName = $row['chat_table_name'];
                echo $chatTableName;
                return "1";
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

