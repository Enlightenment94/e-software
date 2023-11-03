<?php

// Klucz prywatny (nie przesyłaj go nigdy przez Internet)
/*
$fp = fopen("private.key", "r");
$privateKey = fread($fp, filesize("private.key"));
echo filesize("private.key") . "</br>";
fclose($fp);
*/

$privateKey= "-----BEGIN PRIVATE KEY-----
MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCcqm0Sj/sbwzMV
jdkrhMB0TVJYMFWCN3T5BZ6TZz8ASXFdZJP/tXP96aTHVuvpCMYGEUwmEGoGSlhU
JVUVIiHX4om+mcVALC0cQZWuFEBgGsek7hf08Eo+TmyYaWdX3Ng+UeXXvuxbfk4y
9MRiINmEg8EW4ptifbM1U8DsX5Amq9aubUVHhafiGwEOsqCet2tMKVft5CPmi7vI
j8enmJ2aFLyRk7ML+JaFDxScpqUKtzxj+U+kykLC4FiNNHJ4LPrVWZHCdXK1/IPQ
Q6stXf3bgiFm2yG23U28Ldl5uGrnNHOTebvkGgqa9Ez986s7A9M+0PwH6LnFLhue
KyfzNWG3AgMBAAECggEAFPR+zmLP1bDQXmuwxq9lBqlpAD7G0ToVvVFRGqpOtP0d
2r4fRa7Bqw7baYZo26y+wAUESHsdk2XSVr7/mGoOWNAGWKY8yg6eog7rtHMlATXT
ym3Gao7Rf3AB+ojut8PkcMGHmsoA12QXlZ1Dv1Rhg+YTp7n7yrrBg7qGLZfCsklI
Q96QvtLeGSiseH8Z1gw1aQDvMnq3FXougqJGm8IC8Mpz/jkTUQ5rWOm7njU26Xs9
0pfDNXLBYFBnRxEMMUeZNmAOmnejx6t31isLzMQFlhKUacipYwXMakF3CsgbxpZm
1PrSxq9Dq8hW5Ju/cGIeO/ijN2xztCS1wbaXNne7EQKBgQDKmmwWAmuuDuW/51J7
BBn6yb/NmzC+ywgq9ldcftKwbsFN2OLIkHBfC1LJkoP6j56Deb2pY9a1XpY8vzP7
C3XA7F/vGwRQaDd+BRyi6HdM67z/4HUd4uP9yzznzsRtXUk0Xc3BQb7HO4Q5PWUT
nsztBR81oVbVXBDCJjDzY6F2gwKBgQDF9J2U+aZ6NDNHi2G21G/lwZlexKgEq81G
vJYvSmXTY1s8eKUwgl+cmS+D/RYTXEDAdFIGeVDOE3XAPLugLvww6oPbeB/wvGpU
iZfvVatWwLBS3mMeaaM8bnZeAaeTvhJWpiy3XPecEC203ukBcNSj0D5TvrdqUlLa
iW5Zyz4hvQKBgE7wkhKVSN1dwpjeCZ4SwAieGRSEVh7QvtL2fp10cKT70meBjQM2
fAIcSFpvsuqqkMmLYqGgW+T5ALKUkS1Mjsnnj417SlgF8zEvzrOOvgUDiPVtwFQv
tkOJr6ZmQtSV11MHBYc6FZpNDzy6NirJ4fCr4TglL88b+w+aj9IVTLD/AoGAR3+l
1yQgvCzUhLfUMEwkqnC1q6QOJ7nB6BW/jQ8rHiHZ10qgJ5g/Xnl5zwt/iLiebqTU
55+zzur6cde90QqHbkeWHpQRvUrggO49oWVpAGmShivq0xZGrlIbkLK6S0OwrflR
V11N1eGGELkeobWWKCDUEj1lVBKt+F8BK4+cPmUCgYAHpnaE0iAR7WDnRXU5iU0O
I5VxegQpn9Ly8dgEOX16BE5xj8qkwBP6F8D3Pvm7tol/HsJ4MgZD/NO0+bAotrXd
pU5kcUWcOL33h/j99+I/AhYI7xUFsryLEYUZV3AU9kenNJpiHCtu04Io8yJgVm8e
ipUYDWuk8mSSz38ATndspQ==
-----END PRIVATE KEY-----
";

if(isset($_GET['d'])){
    $d = $_GET['d'];
    echo $d;
    echo "\n\n";

    // Odszyfrowanie zaszyfrowanego tekstu przy pomocy klucza prywatnego RSA
    function rsa_decrypt($data, $privateKey) {
        $decodedData = base64_decode($data);
        $plainText = false;
        // Dekodowanie i deszyfrowanie danych
        if (openssl_private_decrypt($decodedData, $plainText, $privateKey, OPENSSL_PKCS1_PADDING)) {
            return $plainText;
        } else {
            return null;
        }
    }

    $encryptedText = $_GET['d'];

    // Wczytanie klucza prywatnego z pliku
    $privateKey = openssl_pkey_get_private(file_get_contents('private.key'));

    // Odszyfrowanie tekstu
    $decryptedText = rsa_decrypt($encryptedText, $privateKey);

    // Zwrócenie wyniku
    echo "Odszyfrowany tekst: " . $decryptedText;
}
?>