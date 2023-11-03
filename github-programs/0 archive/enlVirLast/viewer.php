<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$base = "../";

if(isset($_GET['s'])){
    $s = $_GET['s'];
    $fp = fopen($s, "r");
    $rd = fread($fp, filesize($s));
    fclose($fp);
    echo $rd;
    die();
}
?>

<style>
button{
    background: none;
    color: inherit;
	border: none;
	padding: 3px;
	font: inherit;
	cursor: pointer;
	outline: inherit;
    text-align: left;
}

button:hover{
    border-bottom: 1px solid;
}

</style>

<div style='width: 40%; float: left;'>
<?php
if(isset($_GET['pp'])){
    $p = $_GET['pp'];

    //echo $p;
    $exp = explode("\n", $p);
    echo count($exp);

    echo "output: " . "</br>";

    foreach($exp as $a){
        //echo $a. "</br>";
        //echo '<button onclick=\"show("' . $a . '")\">' . $a . "</button></br>";
        //echo "<button onclick='show(\"" . $a . "\")'>" . $a . "</button></br>";
        $tmp = $base . trim(preg_replace('/\s+/', ' ', $a));
        echo '<button onclick="show(\'' . $tmp . '\')">' . $tmp. "</button></br>";
    }
}
?>
</div>

<div style='width: 60%; float: right; position: fixed; left: 40%;'>
    <textarea id='res' style='width: 100%; height: 700px;'>
    </textarea>
    </br>
    <textarea form='p' name='pp' style='width: 200px; height: 100px;'></textarea>
    <form id='p' aciton='./' method='GET'>
        <input type='submit' value='send'/>
    </form>
</div>

<script>
function show(s) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("res").innerHTML = this.response;
    }
    xhttp.open("GET", "?s=" + s, true);
    xhttp.send();
}
</script>