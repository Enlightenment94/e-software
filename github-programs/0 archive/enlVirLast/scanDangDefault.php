<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("ls.php");
require_once("StringOp.php");

$path = "./wp_cp";
$dange = "default";

if(!file_exists($dange)){
	mkdir($dange);
}

$time = date("Y-m-d H:i:s");

$without = array();
$lsWithout = ls_without($path, $without);

$foundBad = array();
$badFunctions = array("include(", "base64_decode(", "ini_", "md5(", "wp_remote_get");

print_r($badFunctions);

foreach ($lsWithout as $el) {
	foreach($badFunctions as $bad){
		$tmp = $path . "/" . $el;
		$fp = fopen($tmp, "r");
		$size = filesize($tmp);
		if($size > 0){
			$rd = fread($fp, $size);
			if(strpos($rd, $bad)){
				array_push($foundBad, array($el, $bad));	
			}
		}
		fclose($fp);
	}
}

$scanArr = array();
$scan2 = "<scan>\n";
$scan = "<scan>\n";
foreach($foundBad as $el){
	$scan .= "\t<func>\n"; 
	$scan .=  "\t\t<bad>" . $el[1] . "</bad>";
	$scan .=  "\t\t<path>" . $el[0] . "</path>\n";
	$scan .= "\t</func>\n";

	$scan2 .=  "\t\t<bad>" . $el[1] . "</bad>";
	$scan2 .=  "\t\t<path>" . $el[0] . "</path>\n";
	array_push($scanArr, array($el[1], $el[0])); 
}
$scan .= "</scan>\n\n";
$scan2 .= "</scan>\n\n";

//echo "<pre>" . $scan2 . "</pre>";

$scan3 = "<div>";

$scan3 .= "<div style='float: left; width: 10%;'>";
foreach($scanArr as $el){ 
	$scan3 .= $el[0] . "</br>";
}
$scan3 .= "</div>";

$scan3 .= "<div style='float: left; width: 90%;'>";
foreach($scanArr as $el){ 
	$scan3 .= $el[1] . "</br>";
}
$scan3 .= "</div>";

$scan3 .= "</div>";

echo $scan3;
//Find new
?>