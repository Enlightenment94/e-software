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
    require("../class/Record.php");
    ?>

    <div id='menu'>
    </div>

    <div id='content'>
        <?php
            require("../sql/selectAll.php");
            require("../sql/selectTagsByNoteId.php");
            $recArr = selectAll();

            $toWr = "";
            foreach ($recArr as $rec){
                $toWr .= "<rec>\n";
                $toWr .= "\t<note_id>" . $rec->getNote_id() . "</note_id>\n";
                $toWr .= "\t<title>" . $rec->getTitle() . "</title>\n";
                $toWr .= "\t<txt>" . $rec->getText() . "</txt>\n";
                $toWr .= "\t<date>" .$rec->getDate() . "</date>\n";
                $toWr .= "\t<sort_nr>" .$rec->getSort_nr() . "</sort_nr>\n";
                
                $by =  $rec->getNote_id();               
                $selectedTagsArr = selectTagsByNoteId($by);

                $toWr .= "\t<tag>";
                foreach($selectedTagsArr as $tag){
                    $toWr .= $tag . ";";
                }
                $toWr .= "</tag>\n";
                $toWr .= "</rec>\n\n";
            }

            echo "<textarea cols='70' rows='10'>" . $toWr . "</textarea>";

            if($_GET['bp']){
                $bp = $_GET['bp'];
                if($bp = "bp"){
                    $fp = fopen($backUpPath .  "/" . date("Y-m-d H:i:s"), "w");
                    fwrite($fp, $toWr);
                    fclose($fp);
                }
            }
        ?>
        <form action='backupView.php' method='GET'>
            <input name='bp' type='submit' value='bp'/>
        </form>
    </div>

    <div id='foot'></div>
</body>
</html>

