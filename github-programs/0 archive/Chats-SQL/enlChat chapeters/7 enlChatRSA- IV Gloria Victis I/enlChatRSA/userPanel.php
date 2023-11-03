<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['use'])){
    echo "<h1>" . $_SESSION['username'] . "</h1>";
    echo $_SESSION['use'];
    echo "</br>";
}else{
    //header('Location: index.php');
    //die();
}
?>

<style>
#window{
    overflow-y: scroll; 
    height: 300px;
    border: black solid 1px;
    width: 228px;
}
</style>

<input id='pharseKey' type='text' value='rsapass1' />
<input id='find' value='user_2' />
<button onclick='findUser()'>find</button>
<button onclick='getChats()'>chats</button>
<a href='logout.php'>logout</a>
<div id='content'></div>
<div id='log'></div>


<script language="JavaScript" type="text/javascript" src="js/cryptoico/jsbn.js"></script>
<script language="JavaScript" type="text/javascript" src="js/cryptoico/random.js"></script>
<script language="JavaScript" type="text/javascript" src="js/cryptoico/hash.js"></script>
<script language="JavaScript" type="text/javascript" src="js/cryptoico/rsa.js"></script>
<script language="JavaScript" type="text/javascript" src="js/cryptoico/aes.js"></script>
<script language="JavaScript" type="text/javascript" src="js/cryptoico/api.js"></script>

<script>
function findUser() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("content").innerHTML = this.responseText;
    }
    elValue = document.getElementById("find").value;
    xhttp.open("GET", "request.php?fu=" + elValue, true);
    xhttp.send();
}

function createChat(username) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("content").innerHTML = this.responseText;
    }

    xhttp.open("GET", "request.php?ch=t&u=" + username, true);
    xhttp.send();
}

function getChats() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("content").innerHTML = this.responseText;
    }

    xhttp.open("GET", "request.php?gch=t", true);
    xhttp.send();
}

function showChat(chatName) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("content").innerHTML = this.responseText;
    }

    xhttp.open("GET", "request.php?cn=" + chatName, true);
    xhttp.send();
}

function sendMessage(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        //document.getElementById("content").innerHTML = this.responseText;
    }
    
    chatName = document.getElementById("chatName").innerHTML;

    myPublicKey = document.getElementById("myPublicKey").innerHTML;
    reciverPublicKey = document.getElementById("reciverPublicKey").innerHTML;
    message = document.getElementById('message').value;

    //console.log(chatName);
    //console.log("my_public_key: " + myPublicKey);
    //console.log("reciver_public_key: " + reciverPublicKey);
    //console.log("message: " + message);
    //console.log(" ");

    //messageEncryptedMyPublicKey = cryptico.encrypt(message, myPublicKey);
    //messageEncryptedMyPublicKey = cryptico.encrypt(message, cryptico.publicKeyString(rsaKey));
    messageEncryptedReciverPublicKey = cryptico.encrypt(message, reciverPublicKey); 

    //var pharsePass = document.getElementById('pharseKey').value;
    //var rsaKey = cryptico.generateRSAKey(pharsePass, 1024);
    messageEncryptedMyPublicKey = cryptico.encrypt(message, myPublicKey);
    //var decrypted = cryptico.decrypt(messageEncryptedMyPublicKey.cipher, rsaKey);

    //console.log("Use public_key: " + myPublicKey);
    //console.log("Use public_key_2: " + cryptico.publicKeyString(rsaKey));
    //console.log("encrypted: "  + messageEncryptedMyPublicKey.cipher);
    //console.log("Use prv_key: " + rsaKey);
    //console.log("decrypted : " + decrypted.plaintext);

    console.log(messageEncryptedMyPublicKey.cipher);
    xhttp.open("GET", "request.php?cnn=" + chatName + "&mtmt=" + messageEncryptedMyPublicKey.cipher + "&mtyt=" + messageEncryptedReciverPublicKey.cipher, true);
    xhttp.send();
}

setInterval(getMessages, 5000);

function getMessages(){  
    var element =  document.getElementById('window');

    if (typeof(element) != 'undefined' && element != null){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            responseText = this.responseText;
            //document.getElementById('log').innerHTML = responseText.;
            var pharseKey = document.getElementById('pharseKey').value;
            //console.log(pharseKey);
            var rsaKey = cryptico.generateRSAKey(pharseKey, 1024);

            var x, i, xmlDoc, txt;
            var parser = new DOMParser();
            xmlDoc = parser.parseFromString(responseText, "text/xml")
            txt = "";
            usernameArr = xmlDoc.getElementsByTagName("username");
            messageArr = xmlDoc.getElementsByTagName("message");
            var temp = "";
            var replace = "";
            for (i = 0; i < usernameArr.length; i++) {
                temp = "";
                txt += usernameArr[i].childNodes[0].nodeValue + ": ";
                console.log(messageArr[i].childNodes[0].nodeValue);
                replace = messageArr[i].childNodes[0].nodeValue.replaceAll(" ", "+");
                temp = cryptico.decrypt(replace, rsaKey);
                //console.log(messageArr[i].childNodes[0].nodeValue);
                console.log(temp.plaintext);
                txt += temp.plaintext + "<br>";
            }
            document.getElementById("window").innerHTML = txt;
        }
        chatName = document.getElementById("chatName").innerHTML;
        xhttp.open("GET", "request.php?gc=" + chatName, true);
        xhttp.send();    
    }else{
        console.log("window off");
    }

}
</script>

