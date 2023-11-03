<?php
function insertRecord($header, $text, $tags){
	$conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {
		$sql = "insert into " . $GLOBALS['gNoteTable'] . " (note, otxt, date) values ('" . $header . "','" . $text . "','" . date("d-m-y h:i:s") . "')";
        echo $sql;
		$resQuery = $conn->query($sql);
		if ($resQuery === TRUE){
 
		}else {
			die("Connection failed: " . $conn->connect_error);
		}

        $sqlLastId = "select LAST_INSERT_ID()";
        $lastId = "";
        $resQuery = $conn->query($sqlLastId);
        if ($resQuery->num_rows > 0) {
	        while($row = $resQuery->fetch_assoc()) {
                	$lastId = $row['LAST_INSERT_ID()'];
	        } 
        }else {
	        die("Connection failed2: " . $conn->connect_error);
        }

        $tagsIdsArr = array();
        foreach ($tags as $tag){
		    $sqlTagId = "select tag_id from " . $GLOBALS['gTagsTable'] .  " where tag='" . $tag . "'";
		    $tagId = "";

		    $resQuery = $conn->query($sqlTagId);
		    if ($resQuery->num_rows > 0) {
			    while($row = $resQuery->fetch_assoc()) {
				    array_push($tagsIdsArr, $row['tag_id']);
			    } 
		    }else {
			    die("Connection failed3: " . $conn->connect_error);
		    }
        }

        $n = count($tagsIdsArr);
        for($i = 0; $i < $n; $i++){
		    $sqlInsertIdsTags = "insert into " . $GLOBALS['gIdsTagsTable'] . " (tag_id, note_id) values ('" . $tagsIdsArr[$i] .  "','" . $lastId . "')"; 
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
