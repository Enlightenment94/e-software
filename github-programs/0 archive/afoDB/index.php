<html>
<head>
    <link rel='stylesheet' href='style.css'>
    <meta charset='utf-8'>
</head>
<body>
    <div class='dbody'>
    <center>
        <img width='200' height='300' src='logo.jpeg'/>
<pre>"Spójrz na życie człowiek, który oparł swoje życie na mądrości,
 spójrz na życie człowiek, który na jej swego życia nie opiera,
 spójrz na życie swoje."</pre>
        <div class='menu'>
            <a href='index.php'>home</a>
            <a href='about.php'>about</a>
        </div>
    </center>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("./static.php");
require_once("./entity/Afo.php");
require_once("./sql/select/selectAll.php");
require_once("./sql/select/selectTags.php");
require_once("./sql/select/selectByTag.php");

echo "<center>";
$selectForm = "<form id='add' method='get' action='index.php'>";
$tags = selectTags();
foreach($tags as $tg){
    $selectForm .= $tg . " <input type='checkbox' name='chtg[]' value='" . $tg. "'/>";
}
$selectForm .= "<input type='submit' name='s' value='" . "show". "'/>";
$selectForm .= "</form>";
echo $selectForm;
echo "</center>";

if(isset($_GET['s']) && isset($_GET['chtg'])){
    $tags = $_GET['chtg'];
    $records = selectByTag($tags);
    foreach($records as $rec){
        echo $rec->getAfo() . " - ". $rec->getAuthor()  ."</br>";
    }

}else{
    $records = selectAll();
    foreach($records as $rec){
        echo $rec->getAfo() . " - ". $rec->getAuthor()  ."</br>";
    }
} 
?>
    </div>
</body>
</html>
