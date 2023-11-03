<?php
function dropTable($dr){
    $n = count($dr);

	$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {
        for($i = 0; $i < $n; $i++){
            $sqlDrop = "DROP TABLE " . $dr[$i];

            $resQuery = $conn->query($sqlDrop);
		    if ($resQuery === TRUE){
            }else {
                die("Connection failed: " . $conn->connect_error);
            }
        }
		
	}
	$conn->close();
}
?>
