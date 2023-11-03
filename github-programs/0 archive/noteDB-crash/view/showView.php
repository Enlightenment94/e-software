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
    require("../static.php");
    require('atoolbar.php');
    require("../sql/selectTags.php");

    $tagMenu .= "<center>";
    $tagMenu .= "<form action='showView.php' method='get' style='color: #ccc;'>";
    $tagArr = selectTags();
    foreach($tagArr as $tg){
        $tagMenu .= $tg . " <input name='tg[]' type='checkbox' value='".  $tg. "' />";  
    }
    $tagMenu .= "</br><input type='submit' value='show' />";
    $tagMenu .= "</form>";
    $tagMenu .= "</center>";
    echo $tagMenu;
    ?>

    <div id='menu'>
    <?php
    require("../sql/selectAll.php");
    require("../sql/selectByTag.php");
    require("../class/Record.php");

    if(isset($_GET['tg']) && isset($_GET['by'])){
            $tg = $_GET['tg'];
            $getStrTg = "";
            foreach($tg as $t){
                $getStrTg .= "&tg%5B%5D=" . $t;
            }

            $recTagArr = selectByTag($tg);
            $menu = "<ul>";
            foreach ($recTagArr as $rec){
                $menu .= "<li><a href='./showView.php?by=" . $rec->getNote_id() . $getStrTg . "'>" . $rec->getTitle() . "</a></li>";
            }
            $menu .= "</ul>";
            echo $menu;
    }else{
        if(isset($_GET['tg'])){
            $tg = $_GET['tg'];
            $getStrTg = "";
            foreach($tg as $t){
                $getStrTg .= "&tg%5B%5D=" . $t;
            }

            $recTagArr = selectByTag($tg);
            $menu = "<ul>";
            foreach ($recTagArr as $rec){
                $menu .= "<li><a href='./showView.php?by=" . $rec->getNote_id() . $getStrTg . "'>" . $rec->getTitle() . "</a></li>";
            }
            $menu .= "</ul>";
            echo $menu;
        }else{
            $recArr = selectAll();
            $menu = "<ul>";
            foreach ($recArr as $rec){
                $menu .= "<li><a href='./showView.php?by=" . $rec->getNote_id() . "'>" . $rec->getTitle() . "</a></li>";
            }
            $menu .= "</ul>";
            echo $menu;
        }
    }
    ?>
    </div>

    <div id='content'>
    <?php
    require("../sql/selectOne.php");
    if(isset($_GET['by'])){
        $by = $_GET['by'];
        $obj = selectOne($by); 
        echo "<div class='title'>" . $obj->getTitle() . "</div>";
        echo "<div class='text'><pre>" . $obj->getText() . "</pre></div>";
    }else{
        if(isset($_GET['tg']) && isset($_GET['by'])){
            $by = $_GET['by'];
            $obj = selectOne($by); 
            echo "<div class='title'>" . $obj->getTitle() . "</div>";
            echo "<div class='text'><pre>" . $obj->getText() . "</pre></div>";
        }
    }
    ?>
    </div>

    <div id='foot'></div>
</body>
</html>
