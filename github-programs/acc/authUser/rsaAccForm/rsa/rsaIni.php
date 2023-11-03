<?php

if(isset($_GET['init'])){
    if($_GET['init'] == "RSA_0021"){
    }else{
        die();
    }
}

require_once("secretStatic35334543e62ds.php");
require_once("aes.php");

// generowanie kluczy RSA (długość klucza 2048 bitów)
$config = array(
  "digest_alg" => "sha512",
  "private_key_bits" => 2048,
  "private_key_type" => OPENSSL_KEYTYPE_RSA,
);
$res = openssl_pkey_new($config);

// pobieranie klucza publicznego i prywatnego w formacie PEM
$privateKey = "";
openssl_pkey_export($res, $privateKey);
$publicKey = openssl_pkey_get_details($res)['key'];

// zaszyfrowanie tekstu
$plainText = "Hello world";
openssl_public_encrypt($plainText, $encryptedText, $publicKey);

// odszyfrowanie tekstu
openssl_private_decrypt($encryptedText, $decryptedText, $privateKey);

// wyświetlenie wyników
echo "Klucz publiczny:\n$publicKey\n\n";
echo "</br></br>";
echo "Klucz prywatny:\n$privateKey\n\n";
echo "</br></br>";
echo "Tekst do zaszyfrowania:\n$plainText\n\n</br>";
echo "Tekst po zaszyfrowaniu:\n$encryptedText\n\n</br>";
echo "Tekst po odszyfrowaniu:\n$decryptedText\n\n</br></br>";

require_once("../secretStatic.php");

file_put_contents('private.key', '');
file_put_contents('private.key', $privateKey);

echo "Klucz zaszyfrowany: </br>";
echo encryptKey("private.key", $sp);
//echo "<br></br>";
//echo "Klucz odszyfrowany: </br>";
//echo decryptKey("private.key", $sp);

file_put_contents('public.key', '');
$fp = fopen("public.key", "w");
fwrite($fp, $publicKey);
fclose($fp);

?>