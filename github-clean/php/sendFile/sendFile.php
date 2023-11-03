<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if($_FILES['file']['error'] > 0){
    echo 'Problem: ';
    switch($_FILES['file']['error']){
        case 1:
            echo 'Overflow upload_max_filesize';
            break;
        case 2:
            echo 'Overflow max_file_size';
            break;
        case 3:
            echo 'File only piece send';
            break;
        case 4:
            echo 'File not send';
            break;
        case 6:
            echo 'Can not send file, not pointer temporary directory';
            break;
        case 7:
            echo 'Writting file failed';
            break;
        case 8:
            echo 'Bad extend lock server';
            break;
    }
    exit;
}

if($_FILES['file']['type'] != 'image/jpeg'){
    echo 'File is not jpeg';
    exit;
}

$dir = './imgs/' . $_FILES['file']['name'];

if(is_uploaded_file($_FILES['file']['tmp_name']) ){
    if(!move_uploaded_file($_FILES['file']['tmp_name'], $dir) ){
        echo 'File can not copy to directory';
        exit;
    }
}else{
    echo "Possible have problem with somebody: ";
    echo $_FILES['file']['name'];
    exit;
}

echo 'File is corectly send';
echo "<img src='". $dir  . "' />";
?>
