<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("ls.php");

$zip = new ZipArchive();
$time = date("d-m-y h:i:s");
$filename = './bp/archiwum-' . $time . ".zip";


if ($zip->open($filename, ZipArchive::CREATE) !== TRUE) {
    exit('Nie udało się utworzyć archiwum'); 
}

$without = array('enlVir');
$path = '../'; 

$dir = ls_without($path, $without);

foreach ($dir as $el) { 
    //echo $el . "</br>";
    $zip->addFile($path . "/" . $el, $el); 
}

$zip->close();

echo 'Utworzono archiwum zip: ' . $filename;
?>
<p>
    <a href="<?php echo $filename; ?>"><?php echo $filename; ?></a>
</p>