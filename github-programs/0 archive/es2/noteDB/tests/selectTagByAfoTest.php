<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../static.php");
require_once("../entity/Afo.php");
require_once("../sql/select/selectAll.php");
require_once("../sql/select/selectByTag.php");
require_once("../sql/select/selectTagsByNoteId.php");
require_once("../sql/select/selectById.php");

require_once("createTableTest.php");
require_once("insertTagTest.php");
require_once("insertRecordTest.php");
require_once("insertRecordTest1.php");
require_once("insertRecordTest2.php");
require_once("../sql/updateRecord.php");

$by = "1";
$afo = "Changed - Każda dobra energia jest dobra";
$author = "Changed Kamcio";
$otxt = "Changed text1";
$tags = array("tag1");

updateRecord($by, $afo, $author, $otxt, $tags);
$records = selectAll();

$allRecords = "";
foreach($records as $rec){
        $allRecords .= $rec->getAfo() . "</br>";  
}

echo $allRecords;

echo "<br>SelectbyTag</br>";
$tags = array("tag2");
$tagRecords = "";
$records = "";
$records = selectByTag($tags);
foreach($records as $rec){
        $tagRecords .= $rec->getAfo() . "</br>";  
}

echo $tagRecords;

echo "<br>SelectTagByNoteId</br>";
$tags = selectTagsByNoteId("1");
$tagsStr = "";
foreach($tags as $rec){
        $tagsStr .= $rec . "</br>";  
}
echo $tagsStr;
?>



