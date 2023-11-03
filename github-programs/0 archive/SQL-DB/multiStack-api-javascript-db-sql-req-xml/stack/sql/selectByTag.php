<?php
function selectByTag($tg){
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {    
        $tagIdArr = array();
        foreach($tg as $tag){
            $sqlSelect = "SELECT tag_id FROM " . $GLOBALS['gTagsTable'] . " WHERE tag='" . $tag . "'";

            $result = $conn->query($sqlSelect);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    array_push($tagIdArr, $row['tag_id']);
                }
            }else{
                die("Connection failed: " . $conn->connect_error);
            }
        }
        
        $recArr = array();

        $sqlSelect = "SELECT * FROM " . $GLOBALS['gNoteTable'] . " tb, " . $GLOBALS['gIdsTagsTable'] . " tbi WHERE tb.note_id = tbi.note_id";

        $result = $conn->query($sqlSelect);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                foreach($tagIdArr as $id){
                    if($id == $row['tag_id']){
                        $rec = array($row['note_id'], $row['note'], $row['otxt'], $row['date']);   
                        array_push($recArr, $rec);
                    }
                }
            }
        }else{
            die("Connection failed: " . $conn->connect_error);
        }
        $conn->close();
    }
    return $recArr;
}
?>
