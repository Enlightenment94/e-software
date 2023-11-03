<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dir = './posts/';

if(isset($_POST['p']) && isset($_POST['ae']) && isset($_POST['tx'])){
    $pp = $dir . $_POST['p'];
    $tx = $_POST['tx'];
    $fp = fopen($pp, "w");
    fwrite($fp, $tx);
    fclose($fp);
}

if(isset($_POST['p']) && isset($_POST['rn'])){

}

if(isset($_POST['p']) && isset($_POST['d'])){
    $p = $_POST['p'];
    $pp = $dir . $p; 
    $d = $_POST['d'];
    unlink($pp);
}
?>

<link rel='stylesheet' href='style.css'/>

<div id='collapseContent'>
    <center>
    <?php require_once("static.php");?>
    <h1><?php echo $title . " - panel"?></h1>
    <?php require_once("toolbar.php");?>
    </center>
    <?php 
    $rdArr = array();
    $sdir = scandir($dir);

    foreach($sdir as $s){
        $temp = $dir . $s;
        if($temp == $dir . "." || $temp == $dir . ".." ){
            continue;
        }else{
            $fp = fopen($temp, "r");
            $rd = fread($fp, filesize($temp));
            array_push($rdArr, $rd);
            fclose($fp);
        }
    }
    
    array_shift($sdir);
    array_shift($sdir);

    natsort($sdir);

    $indexArr = array();
    $newSdir = array();
    foreach($sdir as $d => $key){
        array_push($indexArr, $d);
        array_push($newSdir, $key);
    }

    $n = count($sdir);
    for($i = 0; $i < $n; $i++){
        echo "<div class='line'>
            <div><button type='button' class='collapsible'>" . $newSdir[$i] . "</button></div>
            <div><button type='button' class='editBtn'>edit</button></div>
        </div>
            <div class='content'><pre>". $rdArr[$indexArr[$i]] . "</pre></div>";
    }
    ?>

    <script src="script.js"></script>
</div>
