<?php
function rsaDecrypt($data, $privateKey) {
    $decodedData = base64_decode($data);
    $plainText = false;
    if (openssl_private_decrypt($decodedData, $plainText, $privateKey, OPENSSL_PKCS1_PADDING)) {
        return $plainText;
    } else {
        return "err_decrypt";
    }
}
?>