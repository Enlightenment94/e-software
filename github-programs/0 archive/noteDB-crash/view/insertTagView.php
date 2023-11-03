<?php require("session/session.php");?>
<form action='./insertTagView.php' method='GET'>
    New tag: <input name='tg' type='text' value='example'/>
    <input name='crt' type='submit' value='create tag' />
</form>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("../sql/insertTag.php");
require("../static.php");

if(isset($_GET['tg']) && isset($_GET['crt'])){
    insertTag($_GET['tg']);
}
?>
