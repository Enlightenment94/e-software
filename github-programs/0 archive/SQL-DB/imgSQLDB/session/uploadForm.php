<?php
require_once('session.php');
require_once('../static.php');
require_once '../sql/deleteImg.php'; 
require_once '../sql/create.php'; 
?>
 <a href='?c=create'>create</a>
<br></br>
<form action="../sql/upload.php" method="post" enctype="multipart/form-data">
    <label>Select Image File:</label>
    <input type="file" name="image">
    <input type="submit" name="submit" value="Upload">
</form>
<?php
//d - delete
//i - id
//c - create
if(isset($_GET['d']) && isset($_GET['i'])){
    $id = $_GET['i'];
    $d = $_GET['d'];
    deleteImg($id);    
}
if(isset($_GET['c'])){
    create();
}

echo "IMAGES:";

$conn = new mysqli($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['db']);  
  
if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}

// Get image data from database 
$result = $conn->query("SELECT id, image, created FROM images ORDER BY id DESC"); 
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
            <div class='id'><?php echo "id: "; echo $row['id']; ?></div>
            <div class='img'>
                <img width='200px' height='200px' src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" /> 
            </div>
            <div class='created'><?php echo "created: "; echo $row['created']; ?></div>
            <div class='delete'><a href='uploadForm.php?i=<?php echo $row['id']; ?>&d=del'>del</a></div>
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
