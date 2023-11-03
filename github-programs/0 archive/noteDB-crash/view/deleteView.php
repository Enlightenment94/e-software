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
    require("session/session.php");
    require("../static.php");
    require('atoolbar.php');
    require("../sql/selectTags.php");
    require("../sql/deleteRec.php");

    $tagMenu .= "<center>";
    $tagMenu .= "<form action='deleteView.php' method='get' style='color: #ccc;'>";
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
            $by = $_GET['by'];
            $tg = $_GET['tg'];
            $getStrTg = "";
            foreach($tg as $t){
                $getStrTg .= "&tg%5B%5D=" . $t;
            }          
            deleteRec($by);
            $recTagArr = selectByTag($tg);
            $menu = "<ul>";
            foreach ($recTagArr as $rec){
                $menu .= "<li><a href='./deleteView.php?by=" . $rec->getNote_id() . $getStrTg . "'>" . $rec->getTitle() . "</a></li>";
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
                $menu .= "<li><a href='./deleteView.php?by=" . $rec->getNote_id() . $getStrTg . "'>" . $rec->getTitle() . "</a></li>";
            }
            $menu .= "</ul>";
            echo $menu;
        }else{
            if(isset($_GET['by'])){ 
                $by = $_GET['by'];
                deleteRec($by);
            }
            $recArr = selectAll();
            $menu = "<ul>";
            foreach ($recArr as $rec){
                $menu .= "<li><a href='./deleteView.php?by=" . $rec->getNote_id() . "'>" . $rec->getTitle() . "</a></li>";
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
