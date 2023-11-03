<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("session/session.php");
require("../sql/selectTags.php");
require("../sql/insertRecord.php");
require("../static.php");

$arr = selectTags();

$checkInput = "";
foreach($arr as $el){
    $checkInput .= $el . " <input name='tg[]' type='checkbox' value='". $el . "'/>";
}

if(isset($_GET['t']) && isset($_GET['tg']) && isset($_GET['nr']) && isset($_GET['tx'])){
    $title = $_GET['t'];
    $text = $_GET['tx'];
    $tags = $_GET['tg'];
    $sort_nr = $_GET['nr'];
    $title = str_replace("'", "''", $title);
    $text = str_replace("'", "''", $text);
    insertRecord($title, $text, $tags, $sort_nr);
}
?>

<form id='insRec' action='./insertRecordView.php' method='GET'>
    <?php echo $checkInput; ?>
<br></br>
    sort_nr: <input name='nr' type='text' value='1' /></br>
    title: </br><textarea form='insRec' name='t' cols='90' rows='5'>abcde</textarea>
    <input type='submit' value='insert' />
</form>

<textarea form='insRec' name='tx' cols='90' rows='20'>abcde</textarea>
