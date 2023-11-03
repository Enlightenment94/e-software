<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'static.php'; 
 
$conn = new mysqli($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['db']);  
// Check connection  
if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}
$sql = "SELECT image FROM images ORDER BY id DESC";
$result = $conn->query($sql); 
?>

<html>
    <head>
        <meta charset='utf-8'/>
        <link rel='stylesheet' href='style.css'>
    </head>
<body>
<?php if($result->num_rows > 0){ ?> 
    <div class="gallery"> 
        <?php while($row = $result->fetch_assoc()){ ?> 
        <div class='box'>
            <img width='200px' height='200px' src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" /> 
<img src="data:image/png;base64,<?php echo base64_encode(file_get_contents("IMAGE URL HERE")) ?>">

        </div>
        <?php } ?> 
    </div> 
<?php }else{ ?> 
    <p class="status error">Image(s) not found...</p> 
<?php } 
$conn->close();
?>
</body>
</html>
