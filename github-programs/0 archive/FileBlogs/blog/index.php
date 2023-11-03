<html>
    </head>
        <link rel="stylesheet" href="style.css" />
    <head>
<body>
    <div id='banner'>
        <center><img src='logo.png' width='300' height='200' /></center>
    </div>
    <div id='menu'>
        <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            $sd = scandir("./posts");
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
                $path = "./posts/". $p; 
                $fp = fopen($path, "r");
                $rd = fread($fp, filesize($path));
                fclose($fp);
                echo $rd;                
            }
        ?>
    </div>
    <div id='foot'></div>
</body>
</html>
