<?php
function updateRecord($by, $note, $otxt, $tags){
	$conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);
    
	if ($conn->connect_error) {
		die("Connection failed0: " . $conn->connect_error);
	}else {
        $sql = "UPDATE " .  $GLOBALS['gNoteTable'] . " SET note='" . $note . "', otxt='" . $otxt . "' WHERE note_id='" . $by . "'"; 
        echo $sql;

		$resQuery = $conn->query($sql);
		if ($resQuery === TRUE){
		}else {
			die("Connection failed1: " . $conn->connect_error);
		}

        $tagIdArr = array();
        foreach($tags as $tag){
            $sqlSelect = "SELECT tag_id FROM " . $GLOBALS['gTagsTable'] . " WHERE tag='" . $tag . "'";
            echo $sqlSelect . "</br>";

            $result = $conn->query($sqlSelect);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    array_push($tagIdArr, $row['tag_id']);
                }
            }else{
                die("Connection failed2: " . $conn->connect_error);
            }
        }

		$sql = "DELETE FROM " . $GLOBALS['gIdsTagsTable'] . " WHERE note_id='" . $by . "'";
        echo $sql . "</br>";
        $resQuery = $conn->query($sql);           
        if ($resQuery === TRUE){              
        }else {
            die("Connection failed3: " . $conn->connect_error);
        }
        
        $n = count($tagIdArr);
        for($i = 0; $i < $n; $i++){
		    $sqlInsertIdsTags = "insert into " . $GLOBALS['gIdsTagsTable'] . " (tag_id, note_id) values ('" . $tagIdArr[$i] .  "','" . $by . "')";
            echo $sqlInsertIdsTags . "</br>"; 
		    $resQuery = $conn->query($sqlInsertIdsTags);
		    if ($resQuery === TRUE){      
		    }else {
			    die("Connection failed4: " . $conn->connect_error);
		    }
        }
    }
	$conn->close();
}
?>
