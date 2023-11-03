<html>
<body>
<?php
$rd="";
$n = basename(__FILE__); 
$fp = fopen($n, "r");
echo $n . "</br>";
$rd = fread($fp, filesize($n));
fclose($fp);

if(isset($_POST['tx']) && isset($_POST['e']) ){
    echo "Print";
    $tx = $_POST['tx'];
    $n = "abc"; 
    $fp = fopen($n, "w");
    fwrite($fp, $tx);
    fclose($fp);
    header("Refresh:0");
}
?>

<form id='area' method='post' aciton='./'>
    <input name='e' type='submit' value='edit'/>
</form>

<textarea cols='150' rows='100' form='area' name='tx'>
    <?php echo $rd;?>
</textarea>
</body>
</html>
