<head>
	<meta charset="utf-8">
</head>
<style>
input[type=button], input[type=submit], input[type=reset] {
    width: 100px;
}
.body{
    width: 600px;
    margin: 0 auto;
}
</style>
<div class='body'>
<?php
session_start();
if(isset($_SESSION['use'])){

}else{
    header("Location: session/secretLogin.php");
    die();
}
?>
<a href='../index.php'>user</a>
<a href='session/logout.php'>logout</a>
<a href='apanel.php'>refresh</a>

<br></br>
<?php
/*
tbn  - tableName
tgn  - tag name
cr   - create table
dr   - drop table submit
i    - insert submit
tg   - tag sumbit
tgtd - tag to delete
rtd  - record to delete
ai   - afo_id
s    - select
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../static.php");
require_once("../entity/Note.php");
require_once("../sql/createTable.php");
require_once("../sql/dropTable.php");
require_once("../sql/insertTag.php");
require_once("../sql/insertRecord.php");
require_once("../sql/select/selectTags.php");
require_once("../sql/select/selectTagsByNoteId.php");
require_once("../sql/select/selectAll.php");
require_once("../sql/select/selectById.php");
require_once("../sql/deleteTags.php");
require_once("../sql/deleteRec.php");
require_once("../sql/updateRecord.php");
require_once("../sql/select/selectByTag.php");
require_once("../class/StringOp.php");
?>

<?php 
if(isset($_GET['tbn']) && isset($_GET['cr'])){
    $tbn = $_GET['tbn'];
    echo $tbn;
    createTable($tbn);
}
?>
<form method='get' action='apanel.php' >
    <div style='width: 450px; text-align: right;'>
CREATE TABLE
        <input type='text' name='tbn' value='' />
        <input type='submit' name='cr' value='create' />
    </div>
</form>

<?php 
if(isset($_POST['tbn']) && isset($_POST['dr'])){
    $tbn = $_POST['tbn'];
    $tableToDrop = array($GLOBALS['beforeTags'] . $tbn, $GLOBALS['beforeIds'] . $tbn, $tbn);
    dropTable($tableToDrop);
}
?>
<form method='post' action='apanel.php' >
    <div style='width: 450px; text-align: right;'>
DROP TABLE
        <input type='text' name='tbn' value='testNote' />
        <input type='submit' name='dr' value='drop' />
    </div>
</form>
<?php
if(isset($_POST['tgn']) && isset($_POST['tg'])){
    $tgn = $_POST['tgn'];
    insertTag($tgn);
}
?>
<form method='post' action='apanel.php' >
    <div style='width: 450px; text-align: right;'>
INSERT TAG
        <input type='text' name='tgn' value='tag1' />
        <input type='submit' name='tg' value='insert tag' />
    </div>
</form>

<?php
$backUpPath = "../bp";
$recArr = selectAll();

$toWr = "";
foreach ($recArr as $rec){
    $toWr .= "<rec>\n";
    $toWr .= "\t<note_id>" . $rec->getNote_id() . "</note_id>\n";
    $toWr .= "\t<note>" . $rec->getNote() . "</note>\n";
    $toWr .= "\t<author>" . $rec->getAuthor() . "</author>\n";
    $toWr .= "\t<otxt>" . $rec->getOtxt() . "</otxt>\n";
    $toWr .= "\t<date>" .$rec->getDate() . "</date>\n";
                
    $by =  $rec->getNote_id();               
    $selectedTagsArr = selectTagsByNoteId($by);

    $toWr .= "\t<tag>";
    foreach($selectedTagsArr as $tag){
        $toWr .= $tag . ";";
    }
    $toWr .= "</tag>\n";
    $toWr .= "</rec>\n\n";
}

echo "<textarea cols='70' rows='10'>" . $toWr . "</textarea>";

if(isset($_GET['bp'])){
    $bp = $_GET['bp'];
    if($bp = "bp"){
        echo $backUpPath .  "/" . date("Y-m-d H:i:s");
        $fp = fopen($backUpPath .  "/" . date("Y-m-d H:i:s"), "w");
        fwrite($fp, $toWr);
        fclose($fp);
    }
}
?>

<form action='apanel.php' method='GET'>
    <input name='bp' type='submit' value='bp'/>
</form>

<?php
    $backUpPath = "../bp";
    require("../class/func.php");     
    $result = fscandir($backUpPath);
    $length = count($result);

    for ($x = 0; $x < $length; $x++) {
    	echo "<a href='?p=" . $result[$x] . "'>" . $result[$x] . "</a></br>";
    }

    if(isset($_GET['p'])){
        $p = $_GET['p'];

        $dr = array();
        array_push($dr, $GLOBALS['beforeIds']. $GLOBALS['table']);
        array_push($dr, $GLOBALS['table']);
        array_push($dr, $GLOBALS['beforeTags']. $GLOBALS['table']);
        dropTable($dr);

        $cr = $GLOBALS['table'];
        createTable($cr);

        $path = $backUpPath . "/" . $p;
        $fp = fopen($path, "r");
        $rd = fread($fp, filesize($path));
        fclose($fp);
      
        $strOp = new StringOp();
        $split2 = $strOp->split2($rd, "<rec>", "</rec>");

        $recArr = array();
        $tagArr = array();
        $tagArrUnique = array();

        foreach($split2 as $s){
            $rec = new Note();
            $temp = $strOp->cut($s, "<note_id>", "</note_id>");
            $rec->setNote_id($temp);
            $temp = $strOp->cut($s, "<note>", "</note>");
            $rec->setNote($temp);
            $temp = $strOp->cut($s, "<author>", "</author>");
            $rec->setAuthor($temp);
            $temp = $strOp->cut($s, "<otxt>", "</otxt>");
            $rec->setOtxt($temp);
            $temp = $strOp->cut($s, "<date>", "</date>");
            $rec->setDate($temp);
            $temp = $strOp->cut($s, "<tag>", "</tag>");
            array_push($tagArr, $temp);
            array_push($recArr, $rec);
            $explode = explode(";", $temp);
            foreach($explode as $exp){
                array_push($tagArrUnique, $exp);
            }
        }

        $tagArrUnique = array_unique($tagArrUnique);
        foreach($tagArrUnique as $tag){
            if($tag != ""){
                insertTag($tag);
            }
        }

        $n = count($recArr);
        echo $n . "</br>";
        for($i = 0 ; $i< $n; $i++){
            $expArr = array();
            $exploded = explode(";", $tagArr[$i]);
            foreach($exploded as $exp){
                //echo "exp : " . $exp;        
                if($exp != ""){
                    array_push($expArr, $exp);
                }
            }
            $note = "";
            $author = "";
            $otxt = "";
            
            $note = $recArr[$i]->getNote();
            $author = $recArr[$i]->getAuthor();
            $otxt = $recArr[$i]->getOtxt();
            insertRecord($note, $author, $otxt, $expArr);
        }            
    }
    echo "</br>";                
?>

SELECT TAGS</br>
<?php
if(isset($_GET['tgtd'])){
    $tgtd = array($_GET['tgtd']);
    deleteTags($tgtd);
    header("Refresh:0; url=apanel.php");
}

$tags = selectTags();
foreach($tags as $tg){
    echo $tg . " <a href='?tgtd=". $tg . "'>" . "del" . "</a></br>";
} 
?>
</br>

<?php 
if(isset($_GET['note']) && isset($_GET['otxt']) && isset($_GET['auth']) && isset($_GET['i']) && isset($_GET['chtg']) ){
    echo "OK!";
    $note = $_GET['note'];
    $otxt = $_GET['otxt'];
    $auth = $_GET['auth'];
    $chtg = $_GET['chtg'];
    $i = $_GET['i'];
    insertRecord($note, $auth, $otxt, $chtg);
}
?>

<?php 
if(isset($_GET['ai']) && isset($_GET['note']) && isset($_GET['otxt']) && isset($_GET['auth']) && isset($_GET['e']) && isset($_GET['chtg']) ){
    echo "OK!";
    $ai = $_GET['ai'];
    $note = $_GET['note'];
    $otxt = $_GET['otxt'];
    $auth = $_GET['auth'];
    $chtg = $_GET['chtg'];
    $e = $_GET['e'];
    updateRecord($ai, $note, $auth, $otxt, $chtg);
}
?>

<?php
if(isset($_GET['ai'])){
    echo "EDIT RECORD";
    $ai = $_GET['ai'];
    $record = selectById($ai);
    $editForm .= "<form method='get' action='apanel.php' id='edit'>";
    $editForm .= "<input name='ai' type='hidden' value='". $ai . "'/>id: " . $ai;
    $editForm .= "<br></br>";
    $tagsAll = selectTags();
    $tagsSelected = selectTagsByNoteId($ai);
    $flag = 0;
    foreach($tagsAll as $tg1){
        $flag = 0;
        foreach($tagsSelected as $tg2){
            if($tg1 == $tg2){
                $editForm .= $tg2 . "<input type='checkbox' checked name='chtg[]' value='" . $tg2. "'/>";
                $flag = 1;
                break;
            }
        }
        if($flag == 0 ){
            $editForm .= $tg1 . " <input type='checkbox' name='chtg[]' value='" . $tg1. "'/>";
        }
    }
    $editForm .= "</br>";
    $editForm .= "Note:</br><textarea cols='50' rows='5' form='edit' name='note'>" . $record->getNote() . "</textarea></br></br>";
    $editForm .= "Author:</br><input type='text' name='auth' value='" . $record->getAuthor() . "'/></br></br>";
    $editForm .= "Opcjonalny text:</br><textarea cols='55' rows='5' form='edit' name='otxt'>" . $record->getOtxt() . "</textarea></br>";
    $editForm .= "<input type='submit' name='e' value='edit' /> ";
    $editForm .= "<input type='submit' name='i' value='insert' />";      
    $editForm .= "";
    $editForm .= "</form>";
    echo $editForm;
}else{
    echo "INSERT RECORD</br>";
    $insertForm = "";
    $insertForm .= "<form id='add' method='get' action='apanel.php'>";
    $tags = selectTags();
    foreach($tags as $tg){
        $insertForm .= $tg . " <input type='checkbox' name='chtg[]' value='" . $tg. "'/>";
    }
    $insertForm .= "<br></br>";
    $insertForm .= "Note:</br><textarea cols='55' rows='5' form='add' name='note'>Sample energy</textarea></br></br>";
    $insertForm .= "Author:</br><input type='text' name='auth' value='Enlightenment'/></br></br>";
    $insertForm .= "Opcjonalny text:</br><textarea cols='55' rows='5' form='add' name='otxt'>Bądź oportunistą, dostosowują się do sytuacji.</textarea></br>";
    $insertForm .= "<input type='submit' name='i' value='insert' />";
    $insertForm .= "</form>";
    echo $insertForm;
}
?>
<?php
if(isset($_GET['rtd'])){
    $rtd = $_GET['rtd'];
    deleteRec($rtd);
    header("Refresh:0; url=apanel.php");
}

$selectForm = "<form id='add' method='get' action='apanel.php'>";
$tags = selectTags();
foreach($tags as $tg){
    $selectForm .= $tg . " <input type='checkbox' name='chtg[]' value='" . $tg. "'/>";
}
$selectForm .= "<input type='submit' name='s' value='" . "select". "'/>";
$selectForm .= "</form>";
echo $selectForm;

if(isset($_GET['s']) && isset($_GET['chtg'])){
    echo "SELECT BY TAGS</br>";
    $tags = $_GET['chtg'];
    $records = selectByTag($tags);
    foreach($records as $rec){
        echo "<a href='?ai=". $rec->getNote_id() . "'>" . "edit" . "</a> ". $rec->getNote_id() . " " . $rec->getNote() . " <a href='?rtd=" . $rec->getNote_id() . "'>del" . "</a></br>";
    }

}else{
    echo "SELECT *</br>";
    $records = selectAll();
    foreach($records as $rec){
        echo "<a href='?ai=". $rec->getNote_id() . "'>" . "edit" . "</a> ". $rec->getNote_id() . " " . $rec->getNote() . " <a href='?rtd=" . $rec->getNote_id() . "'>del" . "</a></br>";
    }
} 
?>
</div>
