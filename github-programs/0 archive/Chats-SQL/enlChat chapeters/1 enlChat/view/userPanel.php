<?php
session_start();
if(isset($_SESSION['use']) && isset($_SESSION['username']) ){
    
}else{
    header("Location: ../index.php");
    die();
}
?>
<html>
    <head>
        <meta charset='utf-8'>
        <link rel='stylesheet' href='style.css'>
        <script language="JavaScript" type="text/javascript" src="../js/cryptoico/jsbn.js"></script>
        <script language="JavaScript" type="text/javascript" src="../js/cryptoico/random.js"></script>
        <script language="JavaScript" type="text/javascript" src="../js/cryptoico/hash.js"></script>
        <script language="JavaScript" type="text/javascript" src="../js/cryptoico/rsa.js"></script>
        <script language="JavaScript" type="text/javascript" src="../js/cryptoico/aes.js"></script>
        <script language="JavaScript" type="text/javascript" src="../js/cryptoico/api.js"></script>
        <script src='enlChat.js'></script>
    </head>
<body>
<h1><?php echo $_SESSION['username']; ?></h1>
<button onclick='testAjax()'>testAjax</button>
<button onclick='showChats()'>show chats</button>
<button onclick='getFriends()'>show friends</button>
<input id='search_friend' name='sf' type='text' value='abc'><button onclick='searchFriend()'>search</button>
<a href='logout.php'>logout</a>
<div id='response'></div>
</body>
</html>
