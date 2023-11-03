<html>
    </head>
        <link rel="stylesheet" href="../style.css"/>
    <head>
<body>
    <div id='banner'>
        <center><img src='../logo' width='300' height='200' /></center>
    </div>
    <?php
    require("session/session.php");
    require("../static.php");
    require('atoolbar.php');
    //require('uaToolbar.php');
    require("../sql/selectTags.php");

    $tagMenu .= "<center>";
    $tagMenu .= "<form action='editView.php' method='get' style='color: #ccc;'>";
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
                $menu .= "<li><a href='./editView.php?by=" . $rec->getNote_id() . $getStrTg . "'>" . $rec->getTitle() . "</a></li>";
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
                $menu .= "<li><a href='./editView.php?by=" . $rec->getNote_id() . $getStrTg . "'>" . $rec->getTitle() . "</a></li>";
            }
            $menu .= "</ul>";
            echo $menu;
        }else{
            $recArr = selectAll();
            $menu = "<ul>";
            foreach ($recArr as $rec){
                $menu .= "<li><a href='./editView.php?by=" . $rec->getNote_id() . "'>" . $rec->getTitle() . "</a></li>";
            }
            $menu .= "</ul>";
            echo $menu;
        }
    }
    ?>
    </div>

    <div id='content'><pre><?php
    $edit .= "<form id='edit' action='./editView.php' method='get' style='color: black;'>";
    require("../sql/selectOne.php");
    require("../sql/selectTagsByNoteId.php");
    if(isset($_GET['by'])){
        $by = $_GET['by'];
        $tagArr = selectTags();
        $checkedTagArr = selectTagsByNoteId($by);

        $flag = 0;
        foreach($tagArr as $tg){
            foreach($checkedTagArr as $t){
                if($tg == $t){
                    $edit .= $tg . " <input name='tg[]' checked type='checkbox' value='".  $tg. "' />";
                    $flag = 1;
                    break;  
                }
            }
            if($flag==1){
                $flag = 0;
                continue;
            }else{
                $edit .= $tg . " <input name='tg[]' type='checkbox' value='".  $tg. "' />";  
            }    
        }
        $edit .= "<br></br>";

        $obj = selectOne($by); 
        $title = str_replace("'", "''", $obj->getTitle());
        $text = str_replace("'", "''", $obj->getText());
        $edit .= "<input type='text' name='nr' value='". $obj->getSort_nr() . "' /><br></br>";
        $edit .= "<textarea form='edit' name='t' cols='95' rows='3'>" . $title . "</textarea></br>";
        $edit .= "<input type='hidden' name='by' value='". $by . "' />";
        $edit .= "<input type='submit' value='edit' />";
        $edit .= "</form>";
        $edit .= "<textarea form='edit' name='tx' cols='95' rows='20'>" . $text . "</textarea>";
        echo $edit;
    }else{
        if(isset($_GET['tg']) && isset($_GET['by'])){
            $by = $_GET['by'];
            $obj = selectOne($by); 
            $tagArr = selectTags();
            $checkedTagArr = selectTagsByNoteId($by);

            $flag = 0;
            foreach($tagArr as $tg){
                foreach($checkedTagArr as $t){
                    if($tg == $t){
                        $edit .= $tg . " <input name='tg[]' checked type='checkbox' value='".  $tg. "' />";
                        $flag = 1;
                        break;  
                    }
                }
                if($flag==1){
                    $flag = 0;
                    continue;
                }else{
                    $edit .= $tg . " <input name='tg[]' type='checkbox' value='".  $tg. "' />";  
                }    
            }
            $edit .= "<br></br>";
            $title = str_replace("'", "''", $obj->getTitle());
            $text = str_replace("'", "''", $obj->getText());
            $edit .= "<input type='text' name='nr' value='". $obj->getSort_nr() . "' /><br></br>";
            $edit .= "<textarea form='edit' name='t' cols='95' rows='3'>" . $title . "</textarea></br>";
            $edit .= "<input type='hidden' name='by' value='". $by . "' />";
            $edit .= "<input type='submit' value='edit' />";
            $edit .= "</form>";
            $edit .= "<textarea form='edit' name='tx' cols='95' rows='20'>" . $text . "</textarea>";
            echo $edit;
        }
    }

    if(isset($_GET['tg']) && isset($_GET['by']) && isset($_GET['t']) && isset($_GET['tx']) && isset($_GET['nr'])){
        require("../sql/updateRecord.php");
        $by = $_GET['by'];
        $t = $_GET['t'];
        $tx = $_GET['tx'];
        $tg = $_GET['tg'];
        $nr = $_GET['nr'];
        $title = str_replace("'", "''", $t);
        $text = str_replace("'", "''", $tx);
        update($by, $title, $text, $nr, $tg);
        header("Location: editView.php?by=" . $by);
        die();
    }  
    ?>
    </pre>
    </div>

    <div id='foot'></div>
</body>
</html>
