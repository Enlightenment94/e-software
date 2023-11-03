<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once('../static.php');
require_once('../sql/createAccTable.php');
require_once('../sql/insertUser.php');
require_once('../sql/insertFriend.php');
require_once('../sql/selectMyFriendsTableName.php');
require_once('../sql/selectUser_id.php');
require_once('../sql/selectUser_id.php');
require_once('../php/rand.php');
require_once('../sql/selectFriendsIds.php');
require_once('../sql/selectFriendsUsernames.php');
require_once('../sql/createChat.php');
require_once('../sql/searchFriend.php');
require_once('../sql/checkChatExist.php');
require_once('../sql/selectMyChats.php');
require_once('../sql/checkOwnerChat.php');
require_once('../sql/removeChat.php');
require_once('../sql/deleteFriend.php');
require_once('../sql/checkTableExist.php');
require_once('../sql/insertMessage.php');
require_once('../sql/selectMessages.php');
require_once('../sql/getSecondOwnerChat.php');
require_once('../sql/selectUsername.php');

if(isset($_GET['testAjax'])){
    echo "Hello world Ajax";
}

//show friends
if(isset($_GET['f'])){
    if($_GET['f'] == 't'){
        $user = $_SESSION['username'];
        $user_id = selectUser_id($user);
        $myFriendsTableName = selectMyFriendsTableName($user_id); 
        $myFriends = selectFriendsUsernames($myFriendsTableName);
        foreach($myFriends as $el){
            echo "<button onclick='startChat(\"" . $el . "\")'>chat</button>". $el . " <a href='request.php?df=" . $el . "'>del</a></br>";
        }
    }
}

//sf - search friend
if(isset($_GET['sf'])){
    $searchStr = $_GET['sf'];
    $usersArr = searchFriend($searchStr);
    foreach($usersArr as $el){
        //echo $el;
        echo $el . " <a href='request.php?af=" . $el . "'>add</a></br>";
    }
}

//af - add friend
if(isset($_GET['af'])){
    $addfriend = $_GET['af'];
    $user = $_SESSION['username'];
    $myUser_id = selectUser_id($user);
    $friendsTableName = selectMyFriendsTableName($myUser_id);
    $friendUser_id = selectUser_id($addfriend);
    insertFriend($friendsTableName, $friendUser_id);
}

//df - del friend
if(isset($_GET['df'])){
    $deletFriend = $_GET['df'];
    $user = $_SESSION['username'];
    $myUser_id = selectUser_id($user);
    $friendsTableName = selectMyFriendsTableName($myUser_id);
    $friendUser_id = selectUser_id($deletFriend);
    deleteFriend($friendUser_id, $friendsTableName);
}

//sc - start chat
if(isset($_GET['sc'])){
    $startChat = $_GET['sc'];
    $user = $_SESSION['username'];
    $myUser_id = selectUser_id($user);
    $startChatUser_id = selectUser_id($startChat);

    echo $startChat . ":";
    $chatTableName = generateRandomString();
    if(checkChatExist($chatTableName)){
        echo "Chat name exist";
    }else{
        echo "Chat create";
        createChat($chatTableName, $myUser_id, $startChatUser_id);
    }
}

//smc - show my chats
if(isset($_GET['smc'])){
    $showMyChats = $_GET['smc'];    
    $user = $_SESSION['username'];
    $myUser_id = selectUser_id($user);
    $chatsArr = selectMyChats($myUser_id);
    foreach($chatsArr as $el){
        echo "<button onclick='showWindowChat(\"" . $el . "\")'>show</button>". $el . " <a href='request.php?dc=" . $el . "'>del</a></br>";
    }
}

//dfc - delete chat
if(isset($_GET['dc'])){
    $deleteChat = $_GET['dc'];
    $user = $_SESSION['username'];
    $myUser_id = selectUser_id($user);
    $areYouOwner = checkOwnerChat($myUser_id, $deleteChat);
    if($areYouOwner == "1"){
        removeChat($deleteChat);
    }  
}

//swc - show window chat
if(isset($_GET['swc'])){
    $showWindowChat = $_GET['swc'];
    echo "<div id='chatName'>" . $showWindowChat . "</div>";
    //check chat exist
    $ret = checkTableExist($showWindowChat);
    if($ret){
        echo "<div id='chatWindow'></div>";
        echo "<input id='sendMessage' type='text' value=''>";
        echo "<button onclick='sendMessage()'>send</button>";  
    }else{
        echo "Chat not exist ";
    }
    //get msg
    //print msg del msg
    //window chat
    //send msg
}

//sm - send message
//cn - chat name
if(isset($_GET['sm']) && isset($_GET['cn'])){
    $sendMessage = $_GET['sm'];
    $chatName = $_GET['cn'];
    $user = $_SESSION['username'];
    $myUser_id = selectUser_id($user);
    $isTableExist = checkTableExist($chatName);
    $areYouOwner = checkOwnerChat($myUser_id, $chatName);
    if( ($areYouOwner == "1") && ($isTableExist == "1") ){
        echo "insert message";
        insertMessage($chatName, $myUser_id, $sendMessage);
    }else{
        echo "Something wrong your chat";
    }
}

//gm - get message
//cn - chat name
if(isset($_GET['gm']) && isset($_GET['cn'])){
    $getMessage = $_GET['gm'];
    $chatName = $_GET['cn'];
    $user = $_SESSION['username'];
    $myUser_id = selectUser_id($user);

    $isTableExist = checkTableExist($chatName);
    $areYouOwner = checkOwnerChat($myUser_id, $chatName);
    $secondOwner = getSecondOwnerChat($myUser_id, $chatName);
    $secondOwnerUsername = selectUsername($secondOwner);

    if( ($areYouOwner == "1") && ($isTableExist == "1") ){
        $messagesArr = selectMessages($chatName);
        foreach($messagesArr as $el){
            if($myUser_id == $el[0]){
                echo $user . ": " . $el[1] . "</br>";
            }else{
                echo $secondOwnerUsername . ": " . $el[1] . "</br>"; 
            }
        }
    }else{
        echo "Something wrong your chat";
    }
}
?>
