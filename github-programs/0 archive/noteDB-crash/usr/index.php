<html>
    </head>
        <link rel="stylesheet" href="../style2.css"/>
    <head>
<body>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require("../static.php");
    require("../sql/selectTags.php");

    $tagMenu .= "<center>";
    $tagMenu .= "<form action='showView2.php' method='get' style='color: #black;'>";
    $tagArr = selectTags();
    foreach($tagArr as $tg){
        $tagMenu .= $tg . " <input name='tg[]' type='checkbox' value='".  $tg. "' />";  
    }
    $tagMenu .= "<p><input type='submit' value='show' /></p>";
    $tagMenu .= "</form>";
    $tagMenu .= "</center>";
    ?>
</body>
<div class='header'>
    <center>
    <?php 
    require_once("uToolbar.php");
    echo $tagMenu;
    ?>
    </center>
</div>

<div class="list">
    <?php
    require_once("../sql/selectAll.php");
    require_once("../sql/selectByTag.php");
    require_once("../class/Record.php");
    if(isset($_GET['tg'])){
        $allRec = selectByTag($tg);
        $html = "";
        $temp = "";

        foreach($allRec as $rec){
            $temp = "";
            $temp .= "<button type='button' class='collapsible'>" . $rec->getTitle() . "</button>";
            $temp .= "<div class='content'>" . $rec->getText() . "</div>";
            $html .= $temp;
        }
        echo $html;
    }else{
        $allRec = selectAll();
        $html = "";
        $temp = "";

        foreach($allRec as $rec){
            $temp = "";
            $temp .= "<button type='button' class='collapsible'>" . $rec->getTitle() . "</button>";
            $temp .= "<div class='content'>" . $rec->getText() . "</div>";
            $html .= $temp;
        }
        echo $html;    
    }
    ?>
</div>
<script src='../script.js'></script>
</html>
