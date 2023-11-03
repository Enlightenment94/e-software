<?php
function fscandir($path) {
    $files = scandir($path);
    $length = count($files);
	        
    $ret = array($length);
    $counter = 0;
    for ($x = 0; $x < $length; $x++) {
        if ($files[$x] != "." && $files[$x] != ".." && $files[$x] != "") {
            $ret[$counter] = $files[$x];
            $counter++;
        }
    }
	        
    return $ret;
}
?>
