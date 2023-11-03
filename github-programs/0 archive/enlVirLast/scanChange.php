<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("ls.php");
require_once("StringOp.php");

function compareFirstLast($path){
		$strOp = new StringOp();
		$lsOne = ls_one($path);
		$length = count($lsOne);

		$fp = fopen($path . "/" . $lsOne[0], "r");
		$first = fread($fp, filesize($path . "/" .  $lsOne[0]) );
		fclose($fp);

		$fp = fopen($path . "/" . $lsOne[$length - 1], "r");
		$last = fread($fp, filesize($path . "/" .  $lsOne[$length - 1]) );
		fclose($fp);

		$split2First = $strOp->split2($first, "<file>", "</file>");
		$split2Last = $strOp->split2($last, "<file>", "</file>");

		$compareCount = 0;
		$result = "<scan>\n";
		$a = count($split2First);
		$b = count($split2Last);
		if($a != $b){
			$result .= "\t<manyChange>True " . $a . " != " . $b .  "</manyChange>\n"; 
		}else{
			$result .= "\t<manyChange>False " . $a . " == " . $b .  "</manyChange>\n"; 
		}
		$result .= "</scan>\n\n";

		$cutArrFirst = array();
		$tmp = "";

		foreach($split2First as $el){
			$tmp = $strOp->cut($el, "<path>", "</path>");
			array_push($cutArrFirst, $tmp);
		}

		$cutArrLast = array();
		foreach($split2Last as $el){
			$tmp = $strOp->cut($el, "<path>", "</path>");
			array_push($cutArrLast, $tmp);
		}

		$sets = array();
		$flag = 0;

		$fp = fopen("./change/logs.txt", "a");

		$setsSize = array();
		//new Files, paths
		foreach($split2Last as $lt){
			$flag = 0;
			$ltPath = $strOp->cut($lt, "<path>", "</path>");
			
			fwrite($fp, $ltPath . "\n");

			foreach($split2First as $ft){
				$ftPath = $strOp->cut($ft, "<path>", "</path>");
				if($ftPath == $ltPath){
					$flag = 1;
					$ltSize = $strOp->cut($lt, "<size>", "</size>");
					$ftSize = $strOp->cut($ft, "<size>", "</size>");
					if($ltSize != $ftSize){
						array_push($setsSize, array($ftSize, $ltSize, $ftPath)); 
					}
					break;
				}
			}

			if($flag == 0){
				array_push($sets, $ltPath);
			}
		}

		$changes = "<newFile>\n";
		foreach ($sets as $el) {
			$changes .= "\t<new>" . $el . "</new>\n";
		}
		$changes .= "</newFile>\n\n";

		$changes .= "<setSize>\n";
		foreach ($setsSize as $el) {
			$changes .= "\t<firstSize>" . $el[0] . "</firstSize>\n";
			$changes .= "\t<lastSize>" . $el[1] . "</lastSize>\n";
			$changes .= "\t<path>" . $el[2] . "</path>\n";
		}
		$changes .= "</setSize>\n\n";

		fwrite($fp, "<ENDuxysEND>" . "\n");
		fclose($fp);

		return $result . $changes;
}

$scan = "";
$change = "change";
$logsTest = "possible";
$dange = "dange";

if(!file_exists($change)){
	mkdir($change);
}

if(!file_exists($logsTest)){
	mkdir($logsTest);
}

$time = date("Y-m-d H:i:sa");

$without = array($change, $logsTest, $dange);
$lsXml = ls_without_size_xml("..", $without);

$dir = ls_one($change);
$n = count($dir);

$content = file_get_contents($change . "/" . $dir[$n - 1]);
$a = strlen($content);
$b = strlen($lsXml);

if( $a == $b){
	$scan .= "\t<change>" . "true" . "</change>: true bez zmian\n";
}else{
	$scan .= "\t<change>" . $a . " != " . $b . "</change>\n";
}

$scan .= "</test>\n\n";

$fp = fopen($change . "/" . $time,  "w");
fwrite($fp, $lsXml);
fclose($fp);

$scan .= compareFirstLast($change);
echo "<pre>" . $scan . "</pre>";
?>