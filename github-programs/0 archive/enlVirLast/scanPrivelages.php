<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("ls.php");

echo "Default privelages:</br>
find ./ -type f -exec chmod 644 {} \;</br>
find ./ -type d -exec chmod 755 {} \;
";
echo "<br></br>";
echo "Hight privelages:<br>";
echo "find . -name 'wp_config.php' -exec chmod 644 {}+";
echo "<br></br>";

$arr = array("enlVir");
$base = "../";
$dir = ls_without($base, $arr);

foreach ($dir as $el) {
    #$perms = fileperms($base . "/" . $el);
    $perms = '0'.sprintf('%d', fileperms($base . "/" . $el) & 0777); 
    $color = ""; // default color
    if ($perms > 0755) {
        $color = "color: red;"; // red color
    } elseif ($perms < 0644) {
        $color = "color: blue;"; // blue color
    }
    echo "<div style=\"" . $color . "\">" . $el . " " . decoct($perms) . "</div>";
    //echo $el . " " . $perms . "</br>";
}

?>