<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("ls.php");
require_once("StringOp.php");

//function compareFirstLast($path, $startPoint, $endPoint, $resultFile){
function compareFirstLast($first, $last){
		$strOp = new StringOp();

		$split2First = $strOp->split2($first, "<file>", "</file>");
		$split2Last = $strOp->split2($last, "<file>", "</file>");

		$result = "";

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

		$setsSize = array();
		//new Files, paths
		foreach($split2Last as $lt){
			$flag = 0;
			$ltPath = $strOp->cut($lt, "<path>", "</path>");

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


		$changes = "";

		if(count($sets) != 0){
			$changes = "<newFile>\n";
			foreach ($sets as $el) {
				$changes .= "\t<new>" . $el . "</new>\n";
			}
			$changes .= "</newFile>\n\n";
		}

		if(count($setsSize) != 0){
			$changes .= "<setSize>\n";
			foreach ($setsSize as $el) {
				$changes .= "\t<firstSize>" . $el[0] . "</firstSize>\n";
				$changes .= "\t<lastSize>" . $el[1] . "</lastSize>\n";
				$changes .= "\t<path>" . $el[2] . "</path>\n";
			}
			$changes .= "</setSize>\n\n";
		}

		return $result . $changes;
}


function partial_ls_without($path, $without){
	$lsXmlArr = ls_without_size_xml_arr("..", $without);

	//Partial save
	$i = 0;
	$j = 0;
	$endArr = count($lsXmlArr);
	$partial = 1000;
	$parts = ceil(count($lsXmlArr) / $partial);
	$k = 0; //
	for($j = 0 ; $j < $parts; $j++){
		$fp = fopen($path . $j, "w");
		for($i = 0; $i < $partial; $i++){
			if($k >= $endArr){
				break;
			}
			fwrite($fp, $lsXmlArr[$k]);
			$k++;
		}
		fclose($fp);
	}
}


function createFirstContener(){
	$change = "change2";
	if(!file_exists($change)){
		mkdir($change);
	}

	$contenerPath = $change . "/" . "first";
	if(!file_exists($contenerPath)){
		mkdir($contenerPath);
		chmod($contenerPath, 0777);
	}else{
		return;
	}

	$without = array($change, "possible", "dange");

	echo "Partial start ..." . "</br>";
	partial_ls_without($contenerPath . "/" , $without);
	echo "Partial end ..." . "</br>";
}


function createContener(){
	$change = "change2";
	if(!file_exists($change)){
		mkdir($change);
	}

	$contenerPath = $change . "/" . "contener";
	if(!file_exists($contenerPath)){
		mkdir($contenerPath);
	}else{
		removeDirectory($contenerPath);
		mkdir($contenerPath);
		chmod($contenerPath, 0777);
	}

	$without = array($change, "possible", "dange");

	echo "Partial start ..." . "</br>";
	partial_ls_without($contenerPath . "/" , $without);
	echo "Partial end ..." . "</br>";
}

function loadContener($path){
	$dir = ls_one($path);
	$content = "";
	$tmp = "";
	foreach($dir as $el){
		echo $path . "/" . $el . "</br>";
		$tmp = file_get_contents($path . "/" . $el);
		$content .= $tmp;
	}
	return $content;
}

$dir = '../';
list($num_dirs, $num_files) = count_files($dir);

echo 'Ilość plików: ' . $num_files . '<br>';
echo 'Ilość folderów: ' . $num_dirs . '<br>';

//Etap pierwszy tworzenie contenerów
createFirstContener();

//Etap drugi porównywanie
//compareFirstLast("change2", $change);
$first = loadContener("./change2" . "/" . "first");
$contenerPath = "./change2" . "/" . "contener";
$dir = ls_one($contenerPath);

if(count($dir) == 1){
	echo "Contener create</br>";
	createContener();
	$oldName = './change2/log.txt';
	$time = date("Y-m-d H:i:sa");
	rename($oldName, "./change2/" . $time . ".log");
}

$counter = 0;
$many = 20;
$dir = ls_one($contenerPath);
foreach($dir as $el){
	if($counter == $many){
		break;
	}
	$last = file_get_contents("./change2" . "/" . "contener/" . $el);
	$result = compareFirstLast($first, $last);
	$fp = fopen("change2/log.txt", "a");
	fwrite($fp, $result);
	fclose($fp);
	unlink("./change2" . "/" . "contener/" . $el);
	$counter++;
}

echo $result;
/*
$dir = ls_one($change);
$n = count($dir);
$content = file_get_contents($change . "/" . $dir[$n - 1]);
*/
//echo "<pre>" . $scan . "</pre>";
?>