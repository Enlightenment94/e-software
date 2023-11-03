<?php require("session/session.php");?>
<form action='./createTbView.php' method='GET'>
    New table name: <input name='tb' type='text' value='example'/>
    <input name='cr' type='submit' value='create' />
</form>
<?php
require("../sql/createTable.php");
require("../static.php");
if(isset($_GET['tb']) && isset($_GET['cr'])){
    createTable($_GET['tb']);
}
?>
