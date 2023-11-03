<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('static.php');
require_once('sql/createTable.php');
require_once('sql/insertUser.php');
require_once('sql/createChat.php');
require_once('sql/selectUserId.php');
require_once('sql/sendMessage.php');
require_once('sql/alterBufferColumn.php');
require_once('sql/selectTablenames.php');
require_once('sql/dropTable.php');

$tablenamesArr = selectTablenames();
foreach($tablenamesArr as $el){
    dropTable($el);
}
createTable();
alterBufferColumn();

?>
