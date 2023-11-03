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
    require("../class/Record.php");
    require("../class/StringOp.php");
    ?>

    <div id='menu'>
    </div>

    <div id='content'>
    <?php
    require("../class/func.php");     
    $result = fscandir($backUpPath);
    $length = count($result);

    for ($x = 0; $x < $length; $x++) {
    	echo "<a href='?p=" . $result[$x] . "'>" . $result[$x] . "</a></br>";
    }

    if($_GET['p']){
        $p = $_GET['p'];

        require("../sql/dropTable.php");
        $dr = array();
        array_push($dr, $GLOBALS['beforeIds']. $GLOBALS['table']);
        array_push($dr, $GLOBALS['table']);
        array_push($dr, $GLOBALS['beforeTags']. $GLOBALS['table']);
        dropTable($dr);

        require("../sql/createTable.php");
        $cr = $GLOBALS['table'];
        createTable($cr);

        $path = $backUpPath . "/" . $p;
        $fp = fopen($path, "r");
        $rd = fread($fp, filesize($path));
        fclose($fp);
      
        $strOp = new StringOp();
        $split2 = $strOp->split2($rd, "<rec>", "</rec>");

        $recArr = array();
        $tagArr = array();
        $tagArrUnique = array();

        foreach($split2 as $s){
            $rec = new Record();
            $temp = $strOp->cut($s, "<note_id>", "</note_id>");
            $rec->setNote_id($temp);
            $temp = $strOp->cut($s, "<title>", "</title");
            $rec->setTitle($temp);
            $temp = $strOp->cut($s, "<txt>", "</txt");
            $rec->setText($temp);
            $temp = $strOp->cut($s, "<date>", "</date>");
            $rec->setDate($temp);
            $temp = $strOp->cut($s, "<sort_nr>", "</sort_nr>");
            $rec->setSort_nr($temp);
            $temp = $strOp->cut($s, "<tag>", "</tag>");
            array_push($tagArr, $temp);
            array_push($recArr, $rec);
            $explode = explode(";", $temp);
            foreach($explode as $exp){
                array_push($tagArrUnique, $exp);
            }
        }

        require("../sql/insertTag.php");      
        $tagArrUnique = array_unique($tagArrUnique);
        foreach($tagArrUnique as $tag){
            if($tag != ""){
                insertTag($tag);
            }
        }

        require("../sql/insertRecord.php");
        $n = count($recArr);
        echo $n . "</br>";
        for($i = 0 ; $i< $n; $i++){
            $expArr = array();
            $exploded = explode(";", $tagArr[$i]);
            foreach($exploded as $exp){
                //echo "exp : " . $exp;        
                if($exp != ""){
                    array_push($expArr, $exp);
                }
            }
            $title = str_replace("'", "''", $recArr[$i]->getTitle());
            $text = str_replace("'", "''", $recArr[$i]->getText());
            insertRecord($title, $text, $expArr, $recArr[$i]->getSort_nr());
        }            
    }                
    ?>

    </div>

    <div id='foot'></div>
</body>
</html>
