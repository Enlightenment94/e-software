<?php
function selectTagsByNoteId($by){
    $selectedTagsArr = array();
    $conn = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);
    if ($conn->connect_error) {
        die("Connection failed there one: " . $conn->connect_error);
    } else {
        $sql = "SELECT distinct tit.tag_id, tt.tag FROM " . $GLOBALS['gNoteTable'] . " t, " . $GLOBALS['gTagsTable'] . " tt, " . $GLOBALS['gIdsTagsTable'] . " tit WHERE tit.note_id = "  . $by ." and t.note_id = tit.note_id and tt.tag_id =  tit.tag_id";
        //echo $sql . "</br>";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($selectedTagsArr, $row['tag']);
            }
        }else{
            echo "Connection failed OMG - brak tags ???: " . $conn->connect_error . "<br></br>";
        }
        $conn->close();
    }
    return $selectedTagsArr;
}
?>
