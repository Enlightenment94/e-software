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
?>