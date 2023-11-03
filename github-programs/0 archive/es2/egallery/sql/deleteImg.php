<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function deleteImg($id){
    $conn = new mysqli($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['db']);  
      
    // Check connection  
    if ($conn->connect_error) {  
        die("Connection failed: " . $conn->connect_error);  
    }
    
    $sql = "delete from images where id='". $id ."'";
    $res = $conn->query($sql);     
    if($res){
    
    }else{
    
    }
    $conn->close();
} 
?>
