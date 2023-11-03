<?php
class FileMgr{
	function rd($path){
		$file = fopen($path, "r") or die("Unable to open file!");
		$ret = fread($file, filesize($path));
		fclose($file);
		return $ret; 
	}
	
	function wr($path, $content){
		$file = fopen($path, "w") or die("Unable to open file!");
		fwrite($file, $content);
		fclose($file);
	}	
}
?>
