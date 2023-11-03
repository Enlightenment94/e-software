<?php 
function checkPassword(){
    strlen($user);
    strlen($pass);
    strlen($repass);
    strlen($captcha);
}

function checkValidateUsername($user){
    if(strlen($user) <= $GLOBALS['gUserLength']){
        return 1;
    }else{
        return 0;
    }
}

function checkValidatePassword($pass){
    if(strlen($pass) <= $GLOBALS['gUserPasswLength']){
        return 1;
    }else{
        return 0;
    }
}

function checkValidateCaptcha($captcha){
    if(strlen($captcha) <= $GLOBALS['gCaptchaLength']){
        return 1;
    }else{
        return 0;
    }
}

function checkValidateMessage($message){
    if(strlen($message) <= $GLOBALS['gMessagesLength']){
        return 1;
    }else{
        return 0;
    }
}

function checkValidateId($id){
    if(strlen($id) <= $GLOBALS['gIdLength']){
        return 1;
    }else{
        return 0;
    }
}

function checkValidateFriendTableName($friendTableName){
    if(strlen($friendTableName) <= $GLOBALS['gFriendTableNameLength']){
        return 1;
    }else{
        return 0;
    }
}

function checkValidateChatTableName($ChatTableName){
    if(strlen($ChatTableName) <= $GLOBALS['gChatTableNameLength']){
        return 1;
    }else{
        return 0;
    }
}
?>
