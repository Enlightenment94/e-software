<?php
function checkTagExist($tag){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {    
            $sqlSelect = "SELECT 1 FROM " . $GLOBALS['gTagsTable'] . " WHERE tag='" . $tag . "'";

            $result = $conn->query($sqlSelect);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    return 1;
                }
            }else{
                //die("Connection failed: " . $conn->connect_error);
            }
    }
	$conn->close();
    return 0;
}
?>
