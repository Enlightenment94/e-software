<?php
$sqlLastId = "select LAST_INSERT_ID()";
$lastId = "";
$resQuery = $conn->query($sqlLastId);
if ($resQuery->num_rows > 0) {
	while($row = $resQuery->fetch_assoc()) {
        	$lastId = $row['LAST_INSERT_ID()'];
	} 
}else {
	die("Connection failed2: " . $conn->connect_error);
}
?>