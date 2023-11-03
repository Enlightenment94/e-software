<?php
$fp = fopen("private.key", "r");
$privateKey = fread($fp, filesize("private.key"));
fclose($fp);

$fp = fopen("public.key", "r");
$publicKey = fread($fp, filesize("public.key"));
fclose($fp);

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
echo "Tekst po odszyfrowaniu:\n$decryptedText\n\n</br>";
?>