<button type="submit" onclick='ajaxEncrypt()'>ajaxEncrypt</button>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jsencrypt/3.1.0/jsencrypt.min.js"></script>

<script>
//<script src='../jsencrypt-master/bin/jsencrypt.min.js'>

function ajaxEncrypt(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        console.log(this.responseText);
    }
    var publicKey = `-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAnKptEo/7G8MzFY3ZK4TA
dE1SWDBVgjd0+QWek2c/AElxXWST/7Vz/emkx1br6QjGBhFMJhBqBkpYVCVVFSIh
1+KJvpnFQCwtHEGVrhRAYBrHpO4X9PBKPk5smGlnV9zYPlHl177sW35OMvTEYiDZ
hIPBFuKbYn2zNVPA7F+QJqvWrm1FR4Wn4hsBDrKgnrdrTClX7eQj5ou7yI/Hp5id
mhS8kZOzC/iWhQ8UnKalCrc8Y/lPpMpCwuBYjTRyeCz61VmRwnVytfyD0EOrLV39
24IhZtshtt1NvC3Zebhq5zRzk3m75BoKmvRM/fOrOwPTPtD8B+i5xS4bnisn8zVh
twIDAQAB
-----END PUBLIC KEY-----
`;

    var d = "";
    var jse = new JSEncrypt();
    jse.setKey(publicKey);
    var plainText = "Hello world";
    var encrypted = jse.encrypt(plainText);

    xhttp.open("GET", "rsaDecrypt.php?d=" + encodeURIComponent(encrypted), true);
    xhttp.send();
}
</script>