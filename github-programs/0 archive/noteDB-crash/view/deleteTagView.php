<?php require("session/session.php");?>
<html>
    </head>
        <link rel="stylesheet" href="../style.css"/>
    <head>
<body>
    <div id='banner'>
        <center><img src='../logo' width='300' height='200' /></center>
    </div>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require("../static.php");
    require('atoolbar.php');
    require("../sql/selectTags.php");
    require("../sql/deleteRec.php");
    require("../sql/deleteTag.php");
    ?>

    <div id='menu'>
    <?php
    require("../sql/selectAll.php");
    require("../sql/selectByTag.php");
    require("../class/Record.php");
    ?>
    </div>

    <div id='content'>
    <?php
    if(isset($_GET['tg'])){
        $tg = $_GET['tg'];
        deleteTag($tg);        
    }

    $tagMenu .= "<center>";
    $tagMenu .= "<form action='deleteTagView.php' method='get' style='color: #ccc;'>";
    $tagArr = selectTags();
    foreach($tagArr as $tg){
        $tagMenu .= $tg . " <input name='tg[]' type='checkbox' value='".  $tg. "' />";  
    }
    $tagMenu .= "</br><input type='submit' value='delete' />";
    $tagMenu .= "</form>";
    $tagMenu .= "</center>";
    echo $tagMenu;
    ?>
    </div>

    <div id='foot'></div>
</body>
</html>
