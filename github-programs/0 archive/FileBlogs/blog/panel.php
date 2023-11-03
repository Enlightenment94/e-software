<html>
    <head>
        <link rel="stylesheet" href="style.css" />
    </head>
<body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$main = "./posts";

if(isset($_SESSION['use'])){
}else{
    header("Location: secretLogin.php");
    die();
}

if(isset($_GET['d']) && isset($_GET['p'])){
    $p = $_GET['p'];
    unlink($main . "/" . $p);
    header("Location: panel.php");
    die();
}

if(isset($_GET['rn']) && isset($_GET['p']) && $_GET['ph']){
    $ph = $main . "/" . $_GET['ph'];
    $p = $main . "/" .  $_GET['p'];
    rename($ph, $p);
}

if(isset($_GET['p']) && isset($_GET['e']) && isset($_GET['tx'])){
    $p = $_GET['p'];
    $tx = $_GET['tx'];
    $path = $main  . "/". $p; 
    $fp = fopen($path, "w");
    fwrite($fp, $tx);
    fclose($fp);    
}
?>
    <div id='banner'></div>

    <div id='menu'>
        <?php
            $sd = scandir($main);
            $n = count($sd);
            echo "<ul id='ulMenu'>";
            foreach ($sd as $el){
                if (strcmp($el, ".") != 0 && strcmp($el,  "..") != 0){
                    echo "<li><a href='./panel.php?p=" . $el . "' />" . $el . "</a></li>";
                }
            }
            echo "</ul>";
        ?>
    </div>
    <div id='content'>
        <?php
            if(isset($_GET['p'])){
                echo "Session: " . $_SESSION['use'];
                $p = $_GET['p'];
                $path = $main . "/". $p; 
                $fp = fopen($path, "r");
                $rd = fread($fp, filesize($path));
                fclose($fp);
            }
        ?>
        <div id='toolbar'>
            <a href='./' style='color: #793862;'>index</a> 
            <a href='./logout.php' style='color: #793862;'>logout</a>
            </br>
            <form id='edit' action='panel.php' method='get' style='display: inline;'>
                file: <input name='p' type='text' value='<?php echo $p;?>'/>
                <input name='e' type='submit' value='edit'/>
                <input name='ph' type='hidden' value='<?php echo $p;?>'/>
                <input name='rn' type='submit' value='rename'/>
                <input name='d' type='submit' value='delete'/>
            </form>
        </div>
</br>
        <?php
            if(isset($_GET['p'])){
                echo "<textarea name='tx' form='edit' cols='95' rows='20'>" . $rd . "</textarea>";                
            }
        ?>
    </div>

    <div id='foot'></div>
</body>
</html>
