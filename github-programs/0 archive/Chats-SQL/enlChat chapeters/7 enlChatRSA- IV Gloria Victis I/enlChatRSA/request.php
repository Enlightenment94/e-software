<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once('static.php');
require_once('sql/createTable.php');
require_once('sql/insertUser.php');
require_once('sql/createChat.php');
require_once('sql/selectUserId.php');
require_once('sql/sendMessage.php');
require_once('php/rand.php');
require_once('sql/login.php');
require_once('sql/findUsers.php');
require_once('sql/selectMyChats.php');
require_once('sql/selectChats.php');
require_once('sql/insertPublicKey.php');
require_once('sql/checkUserHaveChat.php');
require_once('sql/selectPublicKey.php');
require_once('sql/getUserIdFromMyChats.php');
require_once('sql/selectMessages.php');
require_once('sql/selectUserName.php');

//register
if(isset($_GET['u']) && isset($_GET['p']) && isset($_GET['r']) && isset($_GET['pk'])){
    $username = $_GET['u'];
    $password = $_GET['p'];
    $register = $_GET['r'];
    $publicKey = $_GET['pk'];
    $randStr = generateRandomString(); 
    insertUser($username, $password, "u_" . $randStr );

    $userId = selectUserId($username);    
    insertPublicKey($userId, $publicKey);
    header('Location: index.php');
    die();
}

//login
if( isset($_GET['u']) && isset($_GET['p']) && isset($_GET['l']) ){
    $username = $_GET['u'];
    $password = $_GET['p'];
    $login = $_GET['l'];
    if(login($username, $password)){
        $_SESSION['use'] = generateRandomString();    
        $_SESSION['username'] = $username;
        header('Location: userPanel.php');
        die();
    }else{
        header('Location: index.php');
        die();
    }
}

//find users
if(isset($_GET['fu'])){
    $findUser = $_GET['fu'];
    $res = findUsers($findUser);
    foreach($res as $el){
        if($_SESSION['username'] == $el){
        }else{
            echo "<button onclick='createChat(\"" . $el . "\")'>chat</button>" . $el .  "</br>";
        }
    }
}

//create chat
if(isset($_GET['u']) && isset($_GET['ch'])){
    $yourId = selectUserId($_SESSION['username']);
    $yourChatTableName = generateRandomString();

    $secondUsername = $_GET['u'];
    $secondUsernameId = selectUserId($secondUsername);
    $secondUsernameChatTableName = generateRandomString();
    createChat($yourId, $secondUsernameId, $yourChatTableName, $secondUsernameChatTableName);
}

//get my chats
if(isset($_GET['gch'])){
    $yourId = selectUserId($_SESSION['username']);
    $myChats = selectMyChats($yourId);
    $chats = selectChats($myChats);
    foreach($chats as $el){
        echo "<button onclick='showChat(\"" . $el . "\")'>show</button>" .  $el . "</br>";
    }
}

//show chat
if(isset($_GET['cn'])){
    $chatName = $_GET['cn'];
    $username = $_SESSION['username'];
    $userId = selectUserId($username);
    $myChats = selectMyChats($userId);
    $userIdToSend = getUserIdFromMyChats($myChats, $chatName);
    echo $userIdToSend;
    $publicKey = selectPublicKey($userIdToSend);
    $myPublicKey = selectPublicKey($userId);
 
    $chat =  "My public key: <div id='myPublicKey'>" . $myPublicKey . "</div>" . "</br>";  
    $chat .= "Reciver public key: <div id='reciverPublicKey'>" . $publicKey . "</div>" . "</br>";
    $chat .= "<div id='chatName'>" . $chatName . "</div>";
    $chat .= "<div id='window'></div>";
    $chat .= "<input id='message' type='text' value='ssssss'/>";
    $chat .= "<button onclick='sendMessage()'>send</button>";
    echo $chat;
}

//send message
if(isset($_GET['cnn']) && isset($_GET['mtmt']) && isset($_GET['mtyt'])){
    $chatName = $_GET['cnn'];
    $messageToMyTable = $_GET['mtmt']; 
    $messageToYourTable = $_GET['mtyt'];
    //echo $messageToMyTable;
    //echo "<br></br>";
    //echo $messageToYourTable;
    $username = $_SESSION['username'];
    $userId = selectUserId($username);
    sendMessage($userId, $chatName, $messageToMyTable, $messageToYourTable);    
}

//
if(isset($_GET['gc'])){
    $username = $_SESSION['username'];
    $myId = selectUserId($username);

    $getChat = $_GET['gc'];
    $arr = selectMessages($getChat);
    $message = "";
    $flagIKnowWhoWrote = 0;
    $Iknow = "";
    $message .= "<response>";
    foreach($arr as $el){
        if($el[0] == $myId){
            $message .= "<username>" . $username . "</username>";
        }else{
            if($flagIKnowWhoWrote == 0){
                $message .= "<username>" . $username . "</username>";
                $Iknow = selectUserName($el[0]);
                $flagIKnowWhoWrote = 1;
            }else{
                $message .= "<username>" . $Iknow . "</username>";
            }
        }
        $message .= "<message>" . $el[1] . "</message>";
    }
    $message .= "</response>";
    echo $message;
}
?>
