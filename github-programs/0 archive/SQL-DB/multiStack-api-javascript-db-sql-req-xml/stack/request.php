<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('static.php');
require_once('sql/insertTag.php');
require_once('sql/selectTags.php');
require_once('sql/insertRecord.php');
require_once('sql/deleteTag.php');
require_once('sql/insertStack.php');
require_once('sql/selectStacks.php');
require_once('sql/createTable.php');
require_once('sql/dropStack.php');
require_once('sql/selectAll.php');
require_once('sql/updateRecord.php');
require_once('sql/selectTagsByNoteId.php');
require_once('sql/selectByTag.php');
require_once('php/fscandir.php');
require_once('php/StringOp.php');
require_once('sql/checkTagExist.php');
require_once('sql/deleteRecord.php');

if(isset($_GET['delete'])){
    $delete = $_GET['delete'];
    deleteRecord($delete);
}

if( isset($_GET['lbp'])){
    $backUpPath = "bp/" . $_GET['lbp'];
    echo $backUpPath . "</br>";
    $fp = fopen($backUpPath, "r");
    $rd = fread($fp, filesize($backUpPath));
    fclose($fp);

    $strOp = new StringOp();
    $stackToDrop = $strOp->split2($rd, "<stackName>", "</stackName>");
    foreach($stackToDrop as $stack){
        try{
            dropStack($stack);
        }catch (Exception $e){

        }
    }

    $splitOnStack = $strOp->split2($rd, "<stack>", "</stack>");
    $stackName = $strOp->split2($rd, "<stackName>", "</stackName>");
    foreach($stackName as $stack){
        echo $stack . "</br>";
    }echo "</br>";

    $len = count($stackName);
    for($k=0 ; $k < $len; $k++){
        echo $k. " " . $stackName[$k] . "</br>";    
    }

    $w = 0;
    foreach($splitOnStack as $stack){
        echo "</br>" . " STACKNAME " . $w . " " . $stackName[$w] . "</br>";
        //$GLOBALS['gNoteTable'] = $stackName[$w];
        $GLOBALS['gNoteTable'] = $stackName[$w];
        $GLOBALS['gTagsTable'] = "tags_" . $stackName[$w];
        $GLOBALS['gIdsTagsTable'] = "ids_" . $stackName[$w];

        insertStack($stackName[$w]);
        createTable($stackName[$w]);
        $spiltRecords = $strOp->split2($stack, "<rec>", "</rec>");

        $recArr = array();
        $tagArr = array();
        $tagArrUnique = array();
        foreach($spiltRecords as $rec){
            $note = $strOp->cut($rec, "<note>", "</note>");
            $otxt = $strOp->cut($rec, "<otxt>", "</otxt>");
            $tag  = $strOp->cut($rec, "<tag>", "</tag>");
            $temp = array($note, $otxt, $tag);
            array_push($tagArr, $tag);
            array_push($recArr, $temp);
            $explode = explode(";", $tag);
            foreach($explode as $exp){
                array_push($tagArrUnique, $exp);
            }

            $tagArrUnique = array_unique($tagArrUnique);
            foreach($tagArrUnique as $tag){
                if($tag != ""){
                    if(!checkTagExist($tag)){
                        insertTag($tag);
                    }
                }
            }
        }

        $n = count($recArr);
        //echo $n . "</br>";
        for($i = 0 ; $i< $n; $i++){
            $expArr = array();
            $exploded = explode(";", $tagArr[$i]);
            foreach($exploded as $exp){
                if($exp != ""){
                        array_push($expArr, $exp);
                }
            }
                
            $note = $recArr[$i][0];
            $otxt = $recArr[$i][1];
            $mysqli = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);
            $note = $mysqli->real_escape_string($note);
            $otxt = $mysqli->real_escape_string($otxt);
	        $mysqli->close();

            foreach($expArr as $el){
                echo "</br>" .  $el . '</br>';
            }
            insertRecord($note, $otxt, $expArr);
        }
        $w++;
    }
}

if(isset($_GET['gbp'])){
    $backUpPath = "bp";
    $result = fscandir($backUpPath);
    $length = count($result);

    for ($x = 0; $x < $length; $x++) {
    	echo "<a href='request.php?lbp=" . $result[$x] . "'>" . $result[$x] . "</a></br>";
    }
}

if(isset($_GET['bp'])){
    $backUpPath = "bp";
    $stacks = selectStacks();
    $all = "";
    $gTemp = $GLOBALS['gNoteTable'];

    $toWr = "";
    foreach($stacks as $el){
        $GLOBALS['gNoteTable'] = $el;
        $GLOBALS['gTagsTable'] = "tags_" . $el;
        $GLOBALS['gIdsTagsTable'] = "ids_" . $el;
        $recArr = selectAll();
        $toWr .= "\n<stack>\n";
        $toWr .= "\t<stackName>" . $el . "</stackName>\n";
        foreach ($recArr as $recArrEl){
            $toWr .= "\t<rec>\n";
            $toWr .= "\t\t<note_id>" . $recArrEl[0] . "</note_id>\n";
            $toWr .= "\t\t<note>" . $recArrEl[1] . "</note>\n";
            $toWr .= "\t\t<otxt>" . $recArrEl[2] . "</otxt>\n";
            $toWr .= "\t\t<date>" . $recArrEl[3] . "</date>\n";
                        
            $by =  $recArrEl[0];               
            $selectedTagsArr = selectTagsByNoteId($by);

            $toWr .= "\t\t<tag>";
            foreach($selectedTagsArr as $tag){
                $toWr .= $tag . ";";
            }
            $toWr .= "</tag>\n";
            $toWr .= "\t</rec>\n\n";
        }
        $toWr .= "</stack>";
    }
    echo $toWr;

    $fp = fopen($backUpPath .  "/" . date("Y-m-d H:i:s"), "w");
    fwrite($fp, $toWr);
    fclose($fp);
}

if(isset($_GET['selectByTag'])){
    $selectByTag = $_GET['selectByTag'];
    $response = "<response>";
    $arr = selectByTag($selectByTag);
    foreach($arr as $el){
        $response .= "<note_id>" .  $el[0] . "</note_id>";
        $response .= "<note>".  $el[1] . "</note>";
        $response .= "<otxt>".  $el[2] . "</otxt>";
        $response .= "<date>".  $el[3] . "</date>";
    }
    $response .= "</response>";
    echo $response;
}

if(isset($_GET['id2']) && isset($_GET['header2']) && isset($_GET['text2']) && isset($_GET['tags2'])){
    $noteId = $_GET['id2'];
    $header = $_GET['header2'];
    $text = $_GET['text2'];
    $tagsRequest = $_GET['tags2'];

    $mysqli = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);
    $header = $mysqli->real_escape_string($header);
    $text = $mysqli->real_escape_string($text);
	$mysqli->close();

    updateRecord($noteId, $header, $text, $tagsRequest);
    echo "Edit";
}

if(isset($_GET['selectAll'])){
    $selectAll = $_GET['selectAll'];
    $arr = selectAll();
    $response = "<response>";
    foreach($arr as $el){
        $response .= "<note_id>" . $el[0] . "</note_id>";
        $response .= "<note>" . $el[1] . "</note>";
        $response .= "<otxt>" . $el[2] . "</otxt>";
        $response .= "<date>" . $el[3] . "</date>";
    }
    $response .= "</response>";
    echo $response;
}

if(isset($_GET['header']) && isset($_GET['text']) && isset($_GET['tagsRequest'])){
    $header = $_GET['header'];
    $text = $_GET['text'];
    $tagsRequest = $_GET['tagsRequest'];

    $mysqli = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);
    $header = $mysqli->real_escape_string($header);
    $text = $mysqli->real_escape_string($text);
	$mysqli->close();

    insertRecord($header, $text, $tagsRequest);
    echo "Add";
}

if(isset($_GET['setStack'])){
    $stack = $_GET['setStack'];
    $fp = fopen("stack", "w");
    fwrite($fp, $stack);
    fclose($fp);
}

if(isset($_GET['stack'])){
    $stack = $_GET['stack'];
    createTable($stack);
    insertStack($stack);
}

if(isset($_GET['getStacks'])){
    $stack = $_GET['getStacks'];
    $arr = selectStacks();

    $response = "<response>";
    foreach($arr as $el){
        $response .= "<stack>" . $el . "</stack>";
    }
    $response .= "<response>";
    echo $response;
}

if(isset($_GET['deleteStack'])){
    $deleteStack = $_GET['deleteStack'];
    dropStack($deleteStack);
}

if(isset($_GET['tag']) && isset($_GET['addTag'])){
    $addTag = $_GET['addTag'];    
    $tag = $_GET['tag'];
    echo "here";
    insertTag($tag);
}

if(isset($_GET['tag'])){
    $tag = $_GET['tag'];
    $arrTags = selectTags();

    $response = "<response>";
    foreach($arrTags as $el){
        $response .= "<tag_id>" . $el[0] . "</tag_id>";
        $response .= "<tag>" . $el[1] . "</tag>";
    }
    $response .= "<response>";
    echo $response;
}

if(isset($_GET['getTagsNote'])){
    $id = $_GET['getTagsNote'];
    $arrTags = selectTagsByNoteId($id);

    $response = "<response>";
    foreach($arrTags as $el){
        $response .= "<tag>" . $el . "</tag>";
    }
    $response .= "<response>";
    echo $response;
}
    
if(isset($_GET['delTag'])){
    $delTag = $_GET['delTag'];
    deleteTag($delTag);
}

if(isset($_GET['tag']) && isset($_GET['delTag'])){
    //$tag = $_GET['tag'];
}

if(isset($_GET['tags']) && isset($_GET['header']) && isset($_GET['text'])){
    $tags = $_GET['tags'];
    $header = $_GET['header'];
    $text = $_GET['text'];
    foreach($tags as $el){
        echo $el . "</br>";
    }

    $mysqli = new mysqli($GLOBALS['gServername'], $GLOBALS['gUsername'], $GLOBALS['gPassword'], $GLOBALS['gDbname']);
    $header = $mysqli->real_escape_string($header);
    $text = $mysqli->real_escape_string($text);
	$mysqli->close();
   
    insertRecord($header, $text, $tags);
}

if(isset($_GET['getRecords']) && isset($_GET['tags'])){
    $getRecords = $_GET['getRecords'];
    $tags = $_GET['tags'];
}
?>
