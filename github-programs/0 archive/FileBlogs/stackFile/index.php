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

<link rel='stylesheet' href='myStyle.css'/>

<div id='collapseContent'>
    <center>
    <?php require_once("static.php");?>
    <h1><?php echo $title . " - home"?></h1>
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

    $n = count($sdir);
    $i = 2;
    foreach($rdArr as $rd){
        echo "<div class='line'>
            <div><button type='button' class='collapsible'>" . $sdir[$i] . "</button></div>
        </div>
        <div class='content'>
            <pre>" . $rd . "</pre>
        </div>";
        $i++;
    }
    ?>

    <script src="myScript.js"></script>
</div>
