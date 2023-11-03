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

createTable();
insertUser('user_1', 'pass1', "user_1_chats");
insertUser('user_2', 'pass1', "user_2_chats");

$user1Id = selectUserId("user_1");
$user2Id = selectUserId("user_2");

createChat($user1Id, $user2Id, "chat1", "chat2");
//select your chats
sendMessage($user1Id, "chat1", "abcd");
sendMessage($user2Id, "chat2", "xyze");
?>

<script language="JavaScript" type="text/javascript" src="js/cryptoico/jsbn.js"></script>
<script language="JavaScript" type="text/javascript" src="js/cryptoico/random.js"></script>
<script language="JavaScript" type="text/javascript" src="js/cryptoico/hash.js"></script>
<script language="JavaScript" type="text/javascript" src="js/cryptoico/rsa.js"></script>
<script language="JavaScript" type="text/javascript" src="js/cryptoico/aes.js"></script>
<script language="JavaScript" type="text/javascript" src="js/cryptoico/api.js"></script>

<script>
    var passPharse = "Password1";
    var bits = 1024; 
    var rsaKeysA = cryptico.generateRSAKey(passPharse, bits);
    var publicKeyA = cryptico.publicKeyString(rsaKeysA);
</script>

<script>
    var passPharse = "Password2";
    var bits = 1024; 
    var rsaKeysB = cryptico.generateRSAKey(passPharse, bits);
    var publicKeyB = cryptico.publicKeyString(rsaKeysB);
</script>
