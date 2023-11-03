<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('static.php');
require_once('sql/selectAll.php');
require_once('sql/insertPost.php');
require_once('sql/updatePost.php');
require_once('sql/createTable.php');
require_once('sql/dropTable.php');
require_once('sql/updatePost.php');
require_once('sql/deletePost.php');
require_once('php/fscandir.php');
require_once('php/StringOp.php');
require_once('sql/insertPostWithDate.php');

//s - select
if(isset($_GET['s'])){
    $selecet = $_GET['s'];
    $arr = selectAll();
    $response = "<response>";
    foreach($arr as $el){
        $response .= "<post_id>". $el[0] . "</post_id>";
        $response .= "<header>". htmlspecialchars($el[1]) . "</header>";
        $response .= "<post>". htmlspecialchars($el[2]) . "</post>";
        $response .= "<date>". $el[3] . "</date>";
    }
    $response .= "</response>";
    echo $response;
}

//i - insert
if(isset($_GET['i']) && isset($_GET['h']) && isset($_GET['p'])){
    $insert = $_GET['i'];
    $header = $_GET['h'];
    $post = $_GET['p'];
    insertPost($header, $post);    
}  

//e - edit
if(isset($_GET['e']) && isset($_GET['id']) && isset($_GET['h']) && isset($_GET['p'])){
    $edit = $_GET['e'];
    $postId = $_GET['id'];
    $header = $_GET['h'];
    $post = $_GET['p'];
    updatePost($postId, $header, $post);    
}

//d - delete
if(isset($_GET['d']) && isset($_GET['di'])){
    $edit = $_GET['e'];
    $postId = $_GET['di'];
    deletePost($postId);
}

if(isset($_GET['bp'])){
    $arr = selectAll();
    $all = "";
    foreach($arr as $el){
        $record = "<record>\n";
        $record .= "\t<post_id>". $el[0] . "</post_id>\n";
        $record .= "\t<header>". htmlspecialchars($el[1]) . "</header>\n";
        $record .= "\t<post>". htmlspecialchars($el[2]) . "</post>\n";
        $record .= "\t<date>". $el[3] . "</date>\n";
        $record .= "</record>\n\n";
        $all .= $record;
    }

    echo "<plainText>" . $all;
    try{
        $fp = fopen("bp/" . date("d-m-y h:i:s"), "w");
        fwrite($fp, $all);
        fclose($fp);
    }catch (Exception $e){
        echo $e;
    }
}

if(isset($_GET['gbp'])){
    $arr = fscandir("bp/");
    $response = "<response>";
    foreach($arr as $el){
        $response .= "<bp>". $el . "</bp>";
    }
    $response .= "</response>";
    echo $response;
}

if(isset($_GET['lbp'])){
    $loadBp = $_GET['lbp'];
    $fp = fopen("bp/" . $loadBp, "r");
    $rd = fread($fp, filesize("bp/" . $loadBp));
    fclose($fp);

    dropTable($GLOBALS['gPosts']);
    createTable($GLOBALS['gPosts']);
    $op = new StringOp();
    $split2 = $op->split2($rd, "<record>", "</record>");
    foreach($split2 as $el){
        //op->cut($el, "<post_id>", "</post_id>");
        $header = $op->cut($el, "<header>", "</header>");
        $post = $op->cut($el, "<post>", "</post>");
        $date = $op->cut($el, "<date>", "</date>");
        insertPostWithDate($header, $post, $date);
    }
    echo $loadBp;
}
?>
