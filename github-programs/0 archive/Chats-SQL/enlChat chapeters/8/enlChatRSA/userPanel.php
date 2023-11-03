<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleSmall.css">
    <link rel="stylesheet" href="stylejs.css">
    <title>Enlightenmentsoftware - enlRSAchat</title>
</head>

<body>
    <canvas id="matrix"></canvas>
    <script src="js/matrix.js"></script>
    <div id='banner'></div>
    <div id='body'>
        <center><img style="margin-top: 10px;" src='logo.jpeg' width='100px' height='100px'/></center>
        <h2 class='header'>Enlightenmentsoftware - enl<span style="color: crimson;
; text-shadow: 1px 1px rgba(255, 55, 55, 0.6);">RSA</span>chat</h2>
        <div style="height: 30px;">
            <center><a class='githubLink' href='https://github.com/Enlightenment94/e-software'>https://github.com/Enlightenment94/e-software</a></center>
        </div>
        <div id='console'>
            <?php
            session_start();
            if(isset($_SESSION['username']) && isset($_SESSION['use'])){
                echo "<div style='padding-left: 2px; padding-bottom: 5px;'>" . $_SESSION['username'] . ": " . $_SESSION['use'] . "</div>";
            }else{
                header('Location: index.php');
                die();
            }
            ?>
            <div style='margin-bottom: 3px;'>RSA: <input id='pharseKey' type='text' value='rsapass1' /></div>
            
            <input id='find' value='user_2' />
            <button class="button-chat find" onclick='findUser()'>find</button>
            <button class="button-chat get-chats" onclick='getChats()'>chats</button>
            <a href='logout.php'>logout</a>
            <a href="request.php?d=t">delete</a>
            <div id='content'></div>
            <div id='log'></div>
        </div>
    </div>
    <div id='footer'></div>
</body>

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
        var responseText = this.responseText;
        //console.log(responseText);
        var txt = "";
        var parser = new DOMParser();
        xmlDoc = parser.parseFromString(responseText, "text/xml")
        var usernames = xmlDoc.getElementsByTagName("username");
        txt = "<div>";
        for (i = 0; i < usernames.length; i++) {
            txt += "<div>";
            txt += "<button class='button-chat' onclick='createChat(\"" + usernames[i].childNodes[0].nodeValue + "\")'>" + usernames[i].childNodes[0].nodeValue; + "</button></div>";
            txt += "</div>";
        }
        txt += "</div>";
        document.getElementById("content").innerHTML = txt;
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
            var txt = "";
            var responseText = this.responseText;
            var x, i, xmlDoc, txt;
            var parser = new DOMParser();
            xmlDoc = parser.parseFromString(responseText, "text/xml")
            var chats = xmlDoc.getElementsByTagName("chat");
            
            //API
            txt = "<div>"; 
            for (i = 0; i < chats.length; i++) {
                txt += "<div>";
                txt += "<button class='button-chat' onclick='showChat(\"" + chats[i].childNodes[0].nodeValue + "\")'>" + chats[i].childNodes[0].nodeValue; + "</button></div>";
                txt += "<button class='button-chat button-del' onclick='deleteChat(\"" + chats[i].childNodes[0].nodeValue +  "\")'>del</button>";
                txt += "</div>";
            }
            txt += "</div>";
            //console.log(txt);
            document.getElementById('content').innerHTML = txt;
    }

    xhttp.open("GET", "request.php?gch=t", true);
    xhttp.send();
}

function showChat(chatName) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {

        var responseText = this.responseText;
        //console.log(responseText);
        //document.getElementById("content").innerHTML
        var xmlDoc;
        var parser = new DOMParser();
        var xmlDoc = parser.parseFromString(responseText, "text/xml");

        var chatName = xmlDoc.getElementsByTagName("chatName")[0].childNodes[0].nodeValue;
        var myPublicKey = xmlDoc.getElementsByTagName("myPublicKey")[0].childNodes[0].nodeValue;
        var reciverPublicKey = xmlDoc.getElementsByTagName("reciverPublicKey")[0].childNodes[0].nodeValue;
        
        //API implementation
        //console.log(chatName[0].childNodes[0].nodeValue);
        //console.log(myPublicKey[0].childNodes[0].nodeValue);
        //console.log(reciverPublicKey[0].childNodes[0].nodeValue);
        var chat  = "<div id='myPublicKey'>" + myPublicKey + "</div>";  
        chat += "<div id='reciverPublicKey'>" + reciverPublicKey + "</div>";
        chat += "<div id='chatName'>" + chatName + "</div>";
        chat += "<div id='window'></div>";
        chat += "<input id='message' type='text' value='Example'/>";
        chat += "<button onclick='sendMessage()'>send</button>";
        document.getElementById("content").innerHTML = chat;
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

    //console.log(messageEncryptedMyPublicKey.cipher);
    console.log("request.php?cnn=" + chatName + "&mtmt=" + messageEncryptedMyPublicKey.cipher + "&mtyt=" + messageEncryptedReciverPublicKey.cipher);
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
                //console.log(messageArr[i].childNodes[0].nodeValue);
                replace = messageArr[i].childNodes[0].nodeValue.replaceAll(" ", "+");
                temp = cryptico.decrypt(replace, rsaKey);
                //console.log(messageArr[i].childNodes[0].nodeValue);
                //console.log(temp.plaintext);
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

function deleteChat(chatName){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            responseText = this.responseText;
            getChats(); ///Usuń element nie pobieraj całej listy
        }
        xhttp.open("GET", "request.php?dch=" + chatName, true);
        xhttp.send(); 
}
</script>
