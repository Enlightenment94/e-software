<?php
function selectTagsByAfoId($by){
    $selectedTagsArr = array();
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
    if ($conn->connect_error) {
        die("Connection failed there one: " . $conn->connect_error);
    } else {
        $sqlSelect = "SELECT distinct tit.tag_id, tt.tag FROM " . $GLOBALS['table'] . " t, " . $GLOBALS['beforeTags']. $GLOBALS['table'] . " tt, " . $GLOBALS['beforeIds'] . $GLOBALS['table'] . " tit WHERE tit.afo_id ="  . $by ." and t.afo_id = tit.afo_id and tt.tag_id =  tit.tag_id";

        $result = $conn->query($sqlSelect);
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
