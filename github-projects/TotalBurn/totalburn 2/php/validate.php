<?php
function check255($toCheck){
    if(strlen($toCheck) >= 255){
        return 0;
    }
    return 1;
}

function checkCaptcha($captcha){
    if(strlen($captcha) > 6){
        return 0;
    }
    return 1;
}


function encryptedCheck($encrypt){
    if(strlen($encrypt) > 1117){
        return 0;
    }
    return 1;
}

function encodeSpecialChars($str) {
    // Converts special characters to their HTML entities
    $encodedStr = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    return $encodedStr;
}


function checkUserId($userId) {
    $len = strlen($userId);
    if($len >= 0 && $len <= 99999999){
        return 1;
    }else{
        return 0;
    }
}

function checkUsername($username) {
    $len = strlen($username);
    if($len >= 1 && $len <= 16){
        return 1;
    }else{
        return 0;
    }
}

function checkPassword($password) {
    $len = strlen($password);
    if($len >= 1 && $len <= 40){
        return 1;
    }else{
        return 0;
    }
}

function checkPublicKey($publicKey) {
    $len = strlen($publicKey);
    if($len >= 340 && $len <= 345){
        return 1;
    }else{
        return 0;
    }
}

function checkMessage($message) {
    $len = strlen($message);
    if($len >= 170 && $len <= 3000){
        return 1;
    }else{
        return 0;
    }
}

function checkChatName($chatName){
    $len = strlen($chatName);
    if($len >= 8 && $len <= 12){
        return 1;
    }else{
        return 0;
    }
}

function checkTime($time){
    $timeArr = array("1", "3", "5", "15", "30", "60", "360", "1440");
    foreach($timeArr as $el){
        if($time == $el){
            return 1;
        }
    }
    return 0;
}

function checkBurn($time){
    $timeArr = array("60", "360", "720", "1440", "4320", "10080");
    foreach($timeArr as $el){
        if($time == $el){
            return 1;
        }
    }
    return 0;
}

function checkMsgId($msgId) {
    $len = strlen($msgId);
    if($len >= 0 && $len <= 99999999){
        return 1;
    }else{
        return 0;
    }
}
?>