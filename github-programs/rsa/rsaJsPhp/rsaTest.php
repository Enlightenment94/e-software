<?php

// Klucz prywatny (nie przesyłaj go nigdy przez Internet)
$privateKey = "-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC6EaeLHSdsPhfr
J+NJHj+LVHzETg6fWpdFilYXm4CHjXPhIM+ZtcCuZJKT583WkgR3wnbwQ0Hefy6X
UWpgGM0FIXrWdlbNuH9psulcK6PqAOvkTTY7blvFcnzR1CwhkX39RPCKPVuYzg0+
i15NzGHDsfym7HNyHJlJkadiBUFNN/7XKRyPXyOLBmX+qCz/WYorLQJdbr4/XC7r
VUjh3rqjunbMCMRgxyN7j4skwyZOVU02GqQYOa7+i+swsmbBJKQJSWiSVer3GWpF
SqJZlOXbCcC3GRdvKtog2SYBKAJ06s5ewi2K/eXy9odhRcyPEWIym0JQXAH48mSA
6Ru0NxXDAgMBAAECggEAPRzRT5KqwRV/25+FOh2yNzvvorYUfWhOqOtvrV9Ijrz5
42ZYaR7WAzFLJ0MKS0A4MXFwiSc9+isBjXeTHa7nn5jIdKn3hqfjST8XAEvhEVlu
INTvTAPKJoac0noCaKAVplq/Olg+vmhm1zUFKz5GmfTai6S7oi4cdppdRId/VDHR
nGMKBbJ0rss6FzG8CQ90F6/ToZOqvTeUC9lQ9UFA157dEzSbK1NYiQUJWpnuDZei
rzten85L2X23kkfkYxxowaKtU2zPoGw2rghC81ZKgm1XQMHxbfMxt4vA22H5olsU
18836UfSpFFdX23ikv7utSayYF2ZOEUOnW2ry9xpkQKBgQDfeXFYSD6r9GMqs1+G
7xT7Iz7JlBDfz+//cQz4DFSBhgQWph+5UK9TCjsb3lEKD+A9c3sLWW9Ho/NaxqNS
YZEMg5L3xYEjKCrNxFqNPszh5VDKW060N4SZoE4+LRk/g57rAvhhEJm3qm6xEp3M
H05CLBU5jnZfv9tkKhx8U+HSCQKBgQDVJoCKve8F1uKu1Lwm9sNZiK/NhHpffToN
fm3LGc3YrRBi9DyHVc31nceUZeNKJTMun+IFh6GUIlWqF3Saev4e0XeDsnZiTCs3
tNEBf2HwO4NmP4Sq7zBe/MLMb9L/i82/PYgIb/nhecex880q8bBWY1hDWq06uvvH
fvWFOpTsawKBgERLHLRZ/60VFmkqP/tAfSzybHG16iI7raBmsAvt2LVseztgsTk0
yx+ZdM7jdeiZSXH+JJAnWLaQCAKpyaeXYXhtjTBjDz/rOol/hBy+IGa4aaQtmzO/
86nvL3oY1ipu0tYHJlijdhaG4yUCB28l8giO6D2ap9pDC4zkwafNCqnhAoGAcDkS
SnoPw6pMtTHqUjVvys8NiI4sg+QB0aL0GY/fcipES2U+DR8fDidhMf+m+J23Yd/p
93FeoAinw6MP0FnbO8ybOSqX688gnfbEaB5yKTKcTxQ4PGsss4Yu5cYmeEdaL0st
OQwDqzQb8NRk/Cw95G3vxZ6TQC28bF+q0tdyGzsCgYEAvuBtoK3+H8bsI3K7Ybzo
ZiguE+XbzEst/0OENWjU/zhLDU/ZFHbqvmyfSDdL+0xLrpSh1SnYaer0fsDtLPDx
4xfj7BgQ5Tcwq7x8uLLlj/T1yKq+jnUryTmDup2po1M2PL+/jRTBLJEQdJVKdNQE
AP1e2IlOTA86NdChUsCKEZg=
-----END PRIVATE KEY-----
";

if(isset($_GET['d'])){
    $d = $_GET['d'];
    echo $d;
    echo "<br></br>\n\n";

    $config = array(
        "digest_alg" => "sha512",
        "private_key_bits" => 2048,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
    );

    $privateKey = openssl_pkey_get_private($privateKey);
    //openssl_private_decrypt($d, $decryptedText, $privateKey, $config);
    openssl_private_decrypt($decryptedBytes, $decryptedText, $privateKey, OPENSSL_PKCS1_PADDING);
    //openssl_private_decrypt($decryptedBytes, $decryptedText, $privateKey, OPENSSL_PKCS1_PADDING);

    echo "Odszyfrowany tekst: " . $decryptedText;
}
?>