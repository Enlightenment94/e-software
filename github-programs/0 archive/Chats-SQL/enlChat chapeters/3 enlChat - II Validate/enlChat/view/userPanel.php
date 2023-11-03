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
        <script src='enlChat.js'></script>
    </head>
<body>
<h1><?php echo $_SESSION['username']; ?></h1>
<button onclick='testAjax()'>testAjax</button>
<button onclick='showChats()'>show chats</button>
<button onclick='getFriends()'>show friends</button>
<input id='search_friend' name='sf' type='text' value='abc'><button onclick='searchFriend()'>search</button>
<div id='response'></div>
</body>
</html>
