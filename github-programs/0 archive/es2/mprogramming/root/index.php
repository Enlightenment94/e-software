<html>
    </head>
        <link rel="stylesheet" href="style.css" />
        <meta charset='utf-8'>
    <head>
<body>
    <div id='banner'>
        <center><img src='logo.jpeg' width='300' height='200'/></center>
    </div>
    <div class='menu-content'>
        <div id='menu'>
            <?php
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                
                $cp = "currentPath";
                $fp = fopen($cp, "r");
                $rcp = fread($fp, filesize($cp));
                fclose($fp);
                $main = $rcp;
                $sd = scandir($main);
                $n = count($sd);
                echo "<ul id='ulMenu'>";
                foreach ($sd as $el){
                    if (strcmp($el, ".") != 0 && strcmp($el,  "..") != 0){
                        echo "<li><a href='./?p=" . $el . "' />" . $el . "</a></li>";
                    }
                }
                echo "</ul>";
            ?>
        </div>
        <div id='content'>
            <?php
                if(isset($_GET['p'])){
                    $p = $_GET['p'];
                    $path = $rcp . "/" .  $p; 
                    //echo $path;
                    $fp = fopen($path, "r");
                    $rd = fread($fp, filesize($path));
                    fclose($fp);
                    echo $rd;
                }
            ?>
        </div>
    </div>
    <div id='foot'></div>
</body>
</html>
