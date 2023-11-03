<?php
/*	afo_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    afo TEXT,
    author VARCHAR(128), 
    otxt TEXT,
    date VARCHAR(256)
*/
function selectByTag($tg){
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {    
        $tagIdArr = array();
        foreach($tg as $tag){
            $sqlSelect = "SELECT tag_id FROM " . $GLOBALS['beforeTags'] . $GLOBALS['table'] . " WHERE tag='" . $tag . "'";

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
        $sqlSelect = "SELECT * FROM " . $GLOBALS['table'] . " tb, " . $GLOBALS['beforeIds'] . $GLOBALS['table'] . " tbi WHERE tb.afo_id = tbi.afo_id";
        $result = $conn->query($sqlSelect);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                foreach($tagIdArr as $id){
                    if($id == $row['tag_id']){
                        $rec = new Afo($row['afo_id'], $row['afo'], $row['author'], $row['otxt'], $row['date']);   
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
