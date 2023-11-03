<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once('static.php');
require_once('../php/rand.php');
require_once('../php/validate.php');
require_once('../php/time.php');
require_once('../sql/createTable.php');
require_once('../sql/insertUser.php');
require_once('../sql/createChat.php');
require_once('../sql/selectUserId.php');
require_once('../sql/sendMessage.php');
require_once('../sql/login.php');
require_once('../sql/findUsers.php');
require_once('../sql/selectMyChats.php');
require_once('../sql/selectChats.php');
require_once('../sql/insertPublicKey.php');
require_once('../sql/checkUserHaveChat.php');
require_once('../sql/selectPublicKey.php');
require_once('../sql/getUserIdFromMyChats.php');
require_once('../sql/selectMessages.php');
require_once('../sql/selectUserName.php');
require_once('../sql/checkUsernameExist.php');
require_once('../sql/countChats.php');
require_once('../sql/selectChatsPointB.php');
require_once('../sql/deletePublicKey.php');
require_once('../sql/dropTable.php');
require_once('../sql/deleteUser.php');
require_once('../sql/selectChatConnectWithPointA.php');
require_once('../sql/deleteChat.php');
require_once('../sql/deleteMessage.php');
require_once('../sql/readMsg.php');
require_once('../sql/deleteReadMessage.php');
require_once('../sql/checkHowManyMessages.php');
require_once('../sql/deleteLastMessage.php');
require_once('static.php');
require_once("secretStatic35334543e62ds.php");
require_once("rsa.php");
require_once("aes.php");

//register
if(isset($_POST['u']) && isset($_POST['p']) && isset($_POST['pk']) && isset($_POST['c'])){
    $userEncrypted = $_POST['u'];
    $passwordEncrypted = $_POST['p'];
    $captchaEncrypted = $_POST['c'];
    $publicKey = $_POST['pk'];

    $v1 = encryptedCheck($userEncrypted);
    $v2 = encryptedCheck($passwordEncrypted);
    $v4 = encryptedCheck($captchaEncrypted);

    if($v1 != 1 || $v2 != 1 || $v4 != 1){
        die();
    }

    $privateKey = decryptKey('private.key', $sp);
    $privateKey = openssl_pkey_get_private($privateKey);

    $captchaDecrypted = rsaDecrypt($captchaEncrypted, $privateKey);
    $usernameDecrypted = rsaDecrypt($userEncrypted, $privateKey);
    $passwordDecrypted = rsaDecrypt($passwordEncrypted, $privateKey);

    if($usernameDecrypted == "err_decrypt" || $passwordDecrypted == "err_decrypt" || $captchaDecrypted == "err_decrypt"){
        die();        
    }

    $v1 = check255($passwordDecrypted);
    $v2 = check255($usernameDecrypted);
    $v4 = checkCaptcha($captchaDecrypted);
    if($v1 != 1 || $v2 != 1 || $v4 != 1){
        die();
    }

    if($captchaDecrypted == $_SESSION['captcha']){
        //echo "You are human.";
    }else{
        echo "You are not human, mistake or low IQ people.";
        die();
    }

    $usernameValidate = checkUsername($usernameDecrypted);
    $passwordValidate = checkpassword($passwordDecrypted);
    $publicKeyValidate = checkPublicKey($publicKey);

    $username = encodeSpecialChars($usernameDecrypted);
    $password = encodeSpecialChars($passwordDecrypted);
    $publicKey = encodeSpecialChars($publicKey);

    if($usernameValidate == 1 && $passwordValidate == 1 && $publicKeyValidate == 1){
        $randStr = generateRandomString(); 
        if(!checkUsernameExist($username)){
            insertUser($username, $password, "u_" . $randStr );

            $userId = selectUserId($username);    
            insertPublicKey($userId, $publicKey);
            echo "User registred.";
            //echo ("<script>location.href='../index.php';</script>");
            //header('Location: ../index.php');
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
if(isset($_POST['u']) && isset($_POST['p']) && isset($_POST['c'])){
    $userEncrypted = $_POST['u'];
    $passwordEncrypted = $_POST['p'];
    $captchaEncrypted = $_POST['c'];

    $v1 = encryptedCheck($userEncrypted);
    $v2 = encryptedCheck($passwordEncrypted);
    $v3 = encryptedCheck($captchaEncrypted);

    if($v1 != 1 || $v2 != 1 || $v3 !=1){
        die();
    }

    $privateKey = decryptKey('private.key', $sp);
    //$privateKey = openssl_pkey_get_private(file_get_contents('private.key'));
    $privateKey = openssl_pkey_get_private($privateKey);

    $captcha = rsaDecrypt($captchaEncrypted, $privateKey);
    $userDecrypted = rsaDecrypt($userEncrypted, $privateKey);
    $passwordDecrypted = rsaDecrypt($passwordEncrypted, $privateKey);

    if($userDecrypted == "err_decrypt" || $passwordDecrypted == "err_decrypt"){
        die();        
    }

    $v1 = check255($passwordDecrypted);
    $v2 = check255($userDecrypted);
    $v3 = checkCaptcha($captcha);
    if($v1 != 1 || $v2 != 1 || $v3 != 1){
        die();
    }

    if($captcha == $_SESSION['captcha']){
        //echo "You are human.";
    }else{
        echo "You are not human, mistake or low IQ people.";
        die();
    }

    // pobiera dane z formularza i wykonuje zapytanie do bazy danych
    $username = encodeSpecialChars($userDecrypted);
    $password = encodeSpecialChars($passwordDecrypted);

    $usernameValidate = checkUsername($username);
    $passwordValidate = checkpassword($username);
    if($usernameValidate == 1 && $passwordValidate ==1){
        if(login($username, $password)){
            $_SESSION['use'] = generateRandomString();    
            $_SESSION['username'] = $username;
            echo "window.location.href='form/dashboard.php'";
            //echo ("<script>location.href='userPanel.php';</script>");
            //header('location: userPanel.php', true, 302); exit;
            die();
        }else{
            echo "window.location.href='index.php'";
            //echo ("<script>location.href='index.php';</script>");
            //header('location: index.php', true, 302); exit;
            die();
        }
    }else{
        echo "<response>";
        echo "<err>Validate login err.</err>";
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
        
        if($chats != 0){
            foreach($chats as $el){
                $oppositeUserId = getUserIdFromMyChats($myChats, $el);
                $myChatsOppositeUser = selectMyChats($oppositeUserId);

                $chatToDeleteOppositeUser =  selectChatConnectWithPointA($myChats, $el);
                deleteChat($myChatsOppositeUser, $chatToDeleteOppositeUser);
                dropTable($el);
            }
        }

        dropTable($myChats);
        deletePublicKey($userId);
        deleteUser($userId);
    }
}

//find users
if(isset($_GET['fu'])){
    $findUserEncrypted = $_GET['fu'];
    $v1 = encryptedCheck($findUserEncrypted);

    if($v1 != 1){
        die();
    }

    $privateKey = decryptKey('private.key', $sp);
    $privateKey = openssl_pkey_get_private($privateKey);

    $findUser = rsaDecrypt($findUserEncrypted, $privateKey);

    if($findUser == "err_decrypt"){
        echo "err_decrypt";
        die();        
    }

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
    $secondUsernameEncrypted = $_GET['u'];

    $v1 = encryptedCheck($secondUsernameEncrypted);

    if($v1 != 1){
        die();
    }

    $privateKey = decryptKey('private.key', $sp);
    $privateKey = openssl_pkey_get_private($privateKey);

    $secondUsername = rsaDecrypt($secondUsernameEncrypted, $privateKey);

    if($secondUsername == "err_decrypt"){
        echo "err_decrypt";
        die();        
    }  

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

//delete chat dodać api
if(isset($_GET['dch'])){
    $username = $_SESSION['username'];
    $userId = selectUserId($username);

    $deleteChatEncrypted = $_GET['dch'];

    $v1 = encryptedCheck($deleteChatEncrypted);

    if($v1 != 1){
        echo "err";
        die();
    }

    $privateKey = decryptKey('private.key', $sp);
    $privateKey = openssl_pkey_get_private($privateKey);

    $deleteChat = rsaDecrypt($deleteChatEncrypted, $privateKey);

    if($deleteChat == "err_decrypt"){
        echo "err_decrypt";
        die();        
    } 

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
}

//show chat, get chat property
if(isset($_GET['cn'])){
    $chatNameEncrypted = $_GET['cn'];
    $username = $_SESSION['username'];

    $v1 = encryptedCheck($chatNameEncrypted);

    if($v1 != 1){
        echo "err";
        die();
    }

    $privateKey = decryptKey('private.key', $sp);
    $privateKey = openssl_pkey_get_private($privateKey);

    $chatName = rsaDecrypt($chatNameEncrypted, $privateKey);

    if($chatName == "err_decrypt"){
        echo "err_decrypt";
        die();        
    } 

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
if(isset($_GET['cnn']) && isset($_GET['mtmt']) && isset($_GET['mtyt']) && isset($_GET['dt']) && isset($_GET['bt']) ){
    $chatName = $_GET['cnn'];
    $messageToMyTable = $_GET['mtmt']; 
    $messageToYourTable = $_GET['mtyt'];
    $username = $_SESSION['username'];
    $timer = $_GET['dt'];
    $burnTime = $_GET['bt'];

    $yourId = selectUserId($_SESSION['username']);
    $myChats = selectMyChats($yourId);
    
    /*
    $checkOverflowMessages = checkHowManyMessages($chatName);
    if($checkOverflowMessages > 3){
        $chatReciver = selectChatConnectWithPointA($myChats, $chatName);
        //deleteLastMessage($chatName, $chatReciver);
        //die();
    }*/

    $chatNameValidate  = checkChatName($chatName);
    $messageToMyTableValidate = checkMessage($messageToMyTable);
    $messageToYourTableValidate = checkMessage($messageToYourTable);
    $timerValidate = checkTime($timer);
    $brunTimeValidate = checkBurn($burnTime);

    if($chatNameValidate == 1 && $messageToMyTableValidate == 1 && $messageToYourTableValidate == 1 && $timerValidate == 1 && $brunTimeValidate == 1){
        $userId = selectUserId($username);
        $myChats = selectMyChats($userId);
        if(checkUserHaveChat($myChats, $chatName)){
            $destructTime = addTime($timer);
            sendMessage($userId, $chatName, $messageToMyTable, $messageToYourTable, $burnTime, $timer);
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
        $arr = selectMessages($getChat);
        $myChats = selectMyChats($myId);

        $arrIdToBurn = array();
        $arrIdReadBurn = array();
        $currentTime = date('Y-m-d H:i:s');
        $reciverChat = selectChatConnectWithPointA($myChats, $getChat);

        if( checkUserHaveChat($myChats, $getChat) ){
            $message = "";
            $flagIKnowWhoWrote = 0;
            $Iknow = "";
            $message .= "<response>";
            $counter = 0;
            foreach($arr as $el){
                if($currentTime > $el[4]){
                    echo $el[4]. " " . $el[3]. "</br>";
                    array_push($arrIdToBurn, $el[3]);
                    unset($arr[$counter]);
                    $counter++;
                    continue;
                }

                if($currentTime > $el[5] && $el[5] != null){
                    array_push($arrIdReadBurn, $el[3]);
                    unset($arr[$counter]);
                }
                $counter++;
            }

            foreach($arrIdToBurn as $el){
                //echo "destroy " . $el .  " </br>";
                deleteMessage($el, $el, $getChat, $reciverChat);
            }

            foreach($arrIdReadBurn as $el){
                //echo "destroy " . $el .  " </br>";
                deleteReadMessage($el, $getChat);
            }

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
                $message .= "<burn_time>" . $el[4] . "</burn_time>";
                $message .= "<read_time>" . $el[5] . "</read_time>";
            }
            $message .= "</response>";
            echo $message;

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

//???
if(isset($_GET['gcc']) && isset($_GET['mi'])){
    $chatName = $_GET['gcc'];
    $msgId = $_GET['mi'];

    $chatValidate = checkMsgId($msgId);
    $msgIdValidate = checkChatName($chatName);

    if($chatValidate == 1 && $msgIdValidate == 1){
        readMsg($chatName, $msgId);
    }else{
        echo "<response>";
        echo "<err>Read msg validate</err>";
        echo "</response>";
    }
}
?>