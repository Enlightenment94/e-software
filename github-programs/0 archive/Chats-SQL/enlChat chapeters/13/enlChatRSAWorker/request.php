<?php ini_set('display_errors', 1);
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
require_once('php/validate.php');
require_once('sql/checkUsernameExist.php');
require_once('sql/countChats.php');
require_once('sql/selectChatsPointB.php');
require_once('sql/deletePublicKey.php');
require_once('sql/dropTable.php');
require_once('sql/deleteUser.php');
require_once('sql/selectChatConnectWithPointA.php');
require_once('sql/deleteChat.php');
require_once('php/time.php');
require_once('sql/deleteMessage.php');

//register form index.php
//Porównania haseł
if(isset($_GET['u']) && isset($_GET['p']) && isset($_GET['r']) && isset($_GET['pk'])){
    $username = $_GET['u'];
    $password = $_GET['p'];
    $publicKey = $_GET['pk'];
    $register = $_GET['r'];

    $usernameValidate = checkUsername($username);
    $passwordValidate = checkpassword($username);
    $publicKeyValidate = checkPublicKey($publicKey);

    if($usernameValidate == 1 && $passwordValidate == 1 && $publicKeyValidate == 1){
        $randStr = generateRandomString(); 
        if(!checkUsernameExist($username)){
            insertUser($username, $password, "u_" . $randStr );

            $userId = selectUserId($username);    
            insertPublicKey($userId, $publicKey);
            echo ("<script>location.href='index.php';</script>");
            header('Location: index.php');
            die();
        }else{
            echo "<response>";
            echo "<err>Username is busy.</err>";
            echo "</response>";
        }
    }else{
        echo "<response>";
        echo "<err>Validate register err.</err>";
        echo "</response>";
    }
}

//login
if( isset($_GET['u']) && isset($_GET['p']) && isset($_GET['l']) ){
    $username = $_GET['u'];
    $password = $_GET['p'];
    $login = $_GET['l'];
    $usernameValidate = checkUsername($username);
    $passwordValidate = checkpassword($username);
    if($usernameValidate == 1 && $passwordValidate ==1){
        if(login($username, $password)){
            $_SESSION['use'] = generateRandomString();    
            $_SESSION['username'] = $username;
            echo ("<script>location.href='userPanel.php';</script>");
            header('location: userPanel.php', true, 302); exit;
            die();
        }else{
            echo ("<script>location.href='index.php';</script>");
            header('location: index.php', true, 302); exit;
            die();
        }
    }else{
        echo "<response>";
        echo "<err>Validate login err.</err>";
        echo "</response>";
    }
}

//find users
if(isset($_GET['fu'])){
    $findUser = $_GET['fu'];
    $usernameValidate = checkUsername($findUser);
    if($usernameValidate){
        $res = findUsers($findUser);
        $response = "<response>";
        foreach($res as $el){
            if($_SESSION['username'] == $el){
            }else{
                $response .= "<username>" . $el . "</username>";
            }
        }
        $response .= "</response>";
        echo $response;
    }else{
        echo "<response>";
        echo "<err>Validate find err.</err>";
        echo "</response>";
    }
}

//create chat
if(isset($_GET['u']) && isset($_GET['ch'])){
    $yourId = selectUserId($_SESSION['username']);
    $secondUsername = $_GET['u'];
    $usernameValidate = checkUsername($secondUsername);
    if($usernameValidate){
        $secondUsernameId = selectUserId($secondUsername);
        $myChats = selectMyChats($yourId);
        $res = countChats($myChats, $secondUsernameId);
        if($res < 3){
            $yourChatTableName = generateRandomString();
            $secondUsernameChatTableName = generateRandomString();
            createChat($yourId, $secondUsernameId, $yourChatTableName, $secondUsernameChatTableName);
        }else{
            echo "<response>";
            echo "<err>Max 3 chats with One user.</err>";
            echo "</response>";
        }
    }else{
        echo "<response>";
        echo "<err>Validate create chat.</err>";
        echo "</response>";
    }
}

//get my chats
if(isset($_GET['gch'])){
    $yourId = selectUserId($_SESSION['username']);
    $myChats = selectMyChats($yourId);
    $chats = selectChats($myChats);

    $response = "<response>";
    foreach($chats as $el){
        $response .= "<chat>" . $el . "</chat>";
    }
    $response .= "</response>";
    echo $response;
}

//show chat, get chat property
if(isset($_GET['cn'])){
    $chatName = $_GET['cn'];
    $username = $_SESSION['username'];

    $chatNameValidate = checkChatName($chatName);
    if($chatNameValidate == 1){

        $userId = selectUserId($username);
        $myChats = selectMyChats($userId);

        if(checkUserHaveChat($myChats, $chatName)){
            $userIdToSend = getUserIdFromMyChats($myChats, $chatName);
            $myPublicKey = selectPublicKey($userId);
            $reciverPublicKey = selectPublicKey($userIdToSend);

            $chat = "<response>";
            $chat .= "<chatName>" . $chatName . "</chatName>";
            $chat .= "<myPublicKey>" . $myPublicKey. "</myPublicKey>";
            $chat .= "<reciverPublicKey>" . $reciverPublicKey . "</reciverPublicKey>";
            $chat .= "</response>";
            echo $chat;
        }else{
            echo "<response>";
            echo "<err>Show chat err.</err>";
            echo "</response>";
        }
    }else{
        echo "<response>";
        echo "<err>Show chat validate.</err>";
        echo "</response>";
    }
}

//send message
if(isset($_GET['cnn']) && isset($_GET['mtmt']) && isset($_GET['mtyt'])){
    $chatName = $_GET['cnn'];
    $messageToMyTable = $_GET['mtmt']; 
    $messageToYourTable = $_GET['mtyt'];
    $username = $_SESSION['username'];
    $timer = 5;

    $chatNameValidate  = checkChatName($chatName);
    $messageToMyTableValidate = checkMessage($messageToMyTable);
    $messageToYourTableValidate = checkMessage($messageToYourTable);

    if($chatNameValidate == 1 && $messageToMyTableValidate == 1 && $messageToYourTableValidate == 1){
        $userId = selectUserId($username);
        $myChats = selectMyChats($userId);
        if(checkUserHaveChat($myChats, $chatName)){
            $destructTime = addTime($timer);
            sendMessage($userId, $chatName, $messageToMyTable, $messageToYourTable, $destructTime);
        }else{
            echo "<response>";
            echo "<err>Send message err.</err>";
            echo "</response>";
        }
    }else{
        echo "<response>";
        echo "<err>Send message validate.</err>";
        echo "</response>";
    } 
}

//show messages
if(isset($_GET['gc'])){
    $username = $_SESSION['username'];
    $myId = selectUserId($username);

    $getChat = $_GET['gc'];
    $getChatValidate = checkChatName($getChat);

    if($getChatValidate == 1){

        $myChats = selectMyChats($myId);

        $arrIdToDestroy = array();
        $currentTime = date('Y-m-d H:i:s');
        $reciverChat = selectChatConnectWithPointA($myChats, $getChat);

        if( checkUserHaveChat($myChats, $getChat) ){
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
                $message .= "<destruct_time>" . $el[2] . "</destruct_time>";
                $message .= "<msg_id>" . $el[3] . "</msg_id>";

                if($currentTime > $el[2]){
                    echo $el[2]. " " . $el[3]. "</br>";
                    array_push($arrIdToDestroy, $el[3]);
                }
            }
            $message .= "</response>";
            echo $message;
            
            foreach($arrIdToDestroy as $el){
                echo "destroy " . $el .  " </br>";
                deleteMessage($el, $el, $getChat, $reciverChat);
            }
        }else{
            echo "<response>";
            echo "<err>Show message err.</err>";
            echo "</response>";
        }

    }else{
        echo "<response>";
        echo "<err>Show message validate.</err>";
        echo "</response>";
    }
}

//delete account
if(isset($_GET['d'])){
    if($_GET['d'] == 't'){
        $username = $_SESSION['username'];
        $userId = selectUserId($username);
        $myChats = selectMyChats($userId);
        $chats = selectChatsPointB($myChats);
        foreach($chats as $el){
            dropTable($el);
        }

        $chats = selectChats($myChats);

        foreach($chats as $el){
            $oppositeUserId = getUserIdFromMyChats($myChats, $el);
            $myChatsOppositeUser = selectMyChats($oppositeUserId);

            $chatToDeleteOppositeUser =  selectChatConnectWithPointA($myChats, $el);
            deleteChat($myChatsOppositeUser, $chatToDeleteOppositeUser);
            dropTable($el);
        }
        dropTable($myChats);
        deletePublicKey($userId);
        deleteUser($userId);
    }
}

//delete chat dodać api
if(isset($_GET['dch'])){
    $username = $_SESSION['username'];
    $userId = selectUserId($username);

    $deleteChat = $_GET['dch'];
    $deleteChatValidate = checkChatName($deleteChat);
    if($deleteChatValidate == 1){
        $myChats = selectMyChats($userId);
        if(checkUserHaveChat($myChats, $deleteChat)){

            $poinB = selectChatConnectWithPointA($myChats, $deleteChat);
            $oppositeUserId = getUserIdFromMyChats($myChats, $deleteChat);
            $myChatsOppositeUser = selectMyChats($oppositeUserId);
            deleteChat($myChats, $deleteChat);
            deleteChat($myChatsOppositeUser, $poinB);
            echo $deleteChat;
            echo "</br>";
            echo $poinB;
            dropTable($deleteChat);
            dropTable($poinB);
        }else{
            echo "<response>";
            echo "<err>User have not chat.</err>";
            echo "</response>";
        }        

    }else{
        echo "<response>";
        echo "<err>Delete chat validate.</err>";
        echo "</response>";
    }
}?>
