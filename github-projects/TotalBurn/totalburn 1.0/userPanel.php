<?php session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['use'])){
    
    }else{
        echo ("<script>location.href='index.php';</script>");
        header('Location: index.php');
        die();
}?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styleSmall.css">
    <link rel="stylesheet" href="css/stylejs.css">
    <title>TotalBurn</title>
</head>

<body>
    <div id='banner'></div>

    <div id='body'>
        <?php
        require_once("header.php");
        ?>

        <div id='keys'></div>

        <div id='console'>
            <div style='padding-bottom: 5px;'>
                <div style='width:70%; float: left;'>
                    <?php echo $_SESSION['username'] . ": " . $_SESSION['use'];?>
                </div>
                <div style="width:30%; float: left; font-size: 12px: text-align: right;">
                    <a href='logout.php'>logout</a>
                    <a href="request.php?d=t">delete</a>
                </div>
            </div>

            <div style='margin-bottom: 3px; float: none;'>RSA: <input id='pharseKey' type='password' value='rsapass1' /></div>
            <input id='find' value='user_2' />
            <button class="button-chat find" onclick='findUser()'>find</button>
            <button class="button-chat get-chats" onclick='getChats()'>chats</button>

            <div id='blockContent'>
                <div id='content'></div>
                <div id='timeDestructor'>
                    <fieldset>
                        <legend>Time destructor:</legend>

                        <div class='divDestructInput'>
                          <input class='descructInput' type="radio" id="1m" name="destruct" value="1"/>
                          <label for="1m">1m</label>
                        </div>

                        <div class='divDestructInput'>
                          <input class='descructInput' type="radio" id="3m" name="destruct" value="3"/>
                          <label for="3m">3m</label>
                        </div>

                        <div class='divDestructInput'>
                          <input class='descructInput' type="radio" id="5m" name="destruct" value="5" checked/>
                          <label for="5m">5m</label>
                        </div>

                        <div class='divDestructInput'>
                          <input class='descructInput' type="radio" id="15m" name="destruct" value="15"/>
                          <label for="15m">15m</label>
                        </div>

                        <div class='divDestructInput'>
                          <input class='descructInput' type="radio" id="30m" name="destruct" value="30"/>
                          <label for="30m">30m</label>
                        </div>

                        <div class='divDestructInput'>
                          <input class='descructInput' type="radio" id="60m" name="destruct" value="60"/>
                          <label for="60m">60m</label>
                        </div>

                        <div class='divDestructInput'>
                          <input class="descructInput" type="radio" id="6h" name="destruct" value="360"/>
                          <label for="6h">6h</label>
                        </div>

                        <div class='divDestructInput'>
                          <input class="descructInput" type="radio" id="1d" name="destruct" value="1440"/>
                          <label for="1d">1d</label>
                        </div>
                        
                        <div style='font-size: 11px;'>Burn after read</div>
                    </fieldset>
                </div>

                <div id='timeDestructor'>
                    <fieldset>
                        <legend>Total burn:</legend>
                        <div class='divTotalBurnInput'>
                          <input class='totalBurnInput' type="radio" id="60mtb" name="totalBurn" value="60"/>
                          <label for="60m">60m</label>
                        </div>

                        <div class='divTotalBurnInput'>
                          <input class="totalBurnInput" type="radio" id="6htb" name="totalBurn" value="360"/>
                          <label for="6htb">6h</label>
                        </div>

                        <div class='divTotalBurnInput'>
                          <input class="totalBurnInput" type="radio" id="12htb" name="totalBurn" value="720"/>
                          <label for="6htb">12h</label>
                        </div>

                        <div class='divTotalBurnInput'>
                          <input class="totalBurnInput" type="radio" id="1dtb" name="totalBurn" value="1440" checked/>
                          <label for="1dtb">1d</label>
                        </div>

                        <div class='divTotalBurnInput'>
                          <input class="totalBurnInput" type="radio" id="3dtb" name="totalBurn" value="4320"/>
                          <label for="1dtb">3d</label>
                        </div>

                        <div class='divTotalBurnInput'>
                          <input class="totalBurnInput" type="radio" id="7dtb" name="totalBurn" value="10080"/>
                          <label for="1dtb">7d</label>
                        </div>
                        
                        <div style='font-size: 11px;'>All long is burned</div>
                    </fieldset>
                </div>
            </div>
            <div id='log'></div>
        </div>

        <div style='width:300px; margin: 0 auto;'>
            <canvas id="c"></canvas>
        </div>
        <script src="js/burn.js"></script>
    </div>

    <div id='footer'></div>
</body>

<script language="JavaScript" type="text/javascript" src="js/cryptoico/jsbn.js"></script>
<script language="JavaScript" type="text/javascript" src="js/cryptoico/random.js"></script>
<script language="JavaScript" type="text/javascript" src="js/cryptoico/hash.js"></script>
<script language="JavaScript" type="text/javascript" src="js/cryptoico/rsa.js"></script>
<script language="JavaScript" type="text/javascript" src="js/cryptoico/aes.js"></script>
<script language="JavaScript" type="text/javascript" src="js/cryptoico/api.js"></script>
<script src='msg.js'></script>

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

var worker;
var element = "";

function workerUp(){
        worker = new Worker('messages.js');
        worker.addEventListener('message', function(e) {
            element =  document.getElementById('window');
            if (typeof(element) != 'undefined' && element != null){
                document.getElementById('window').innerHTML = e.data;
            }else{
                worker.postMessage('stop');
                console.log("close");
            } 
        }, false);

        // wyslanie wiadomosci start
        var pharseKey = document.getElementById('pharseKey').value;
        var chatName = document.getElementById("chatName").innerHTML;
        var arr = new Array(pharseKey, chatName);
        worker.postMessage(arr);
}

function showChat(chatName) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {

        var responseText = this.responseText;
        var xmlDoc;
        var parser = new DOMParser();
        var xmlDoc = parser.parseFromString(responseText, "text/xml");

        var chatName = xmlDoc.getElementsByTagName("chatName")[0].childNodes[0].nodeValue;
        var myPublicKey = xmlDoc.getElementsByTagName("myPublicKey")[0].childNodes[0].nodeValue;
        var reciverPublicKey = xmlDoc.getElementsByTagName("reciverPublicKey")[0].childNodes[0].nodeValue;
        
        var chat  = "<div id='myPublicKey'>" + myPublicKey + "</div>";  
        chat += "<div id='reciverPublicKey'>" + reciverPublicKey + "</div>";
        chat += "<div id='chatName'>" + chatName + "</div>";
        chat += "<div id='window'></div>";
        chat += "<input id='message' type='text' value='Example'/>";
        chat += "<button onclick='sendMessage()'>send</button>";
        document.getElementById("content").innerHTML = chat;
        workerUp();
    }

    xhttp.open("GET", "request.php?cn=" + chatName, false);
    xhttp.send();
}

function sendMessage(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        //worker.postMessage('stop');
        //workerUp();
        //document.getElementById("content").innerHTML = this.responseText;
    }
    
    chatName = document.getElementById("chatName").innerHTML;

    myPublicKey = document.getElementById("myPublicKey").innerHTML;
    reciverPublicKey = document.getElementById("reciverPublicKey").innerHTML;
    message = document.getElementById('message').value;

    messageEncryptedReciverPublicKey = cryptico.encrypt(message, reciverPublicKey); 
    messageEncryptedMyPublicKey = cryptico.encrypt(message, myPublicKey);

    let destructInput = document.getElementsByClassName('descructInput');
    let i;
    let destructTime = 1;
    console.log(destructInput.length);
    for(i = 0; i < destructInput.length; i++){
        if(destructInput[i].checked == true){
            destructTime = destructInput[i].value;
        }
    }
    console.log(destructTime);

    let totalBurnInput = document.getElementsByClassName('totalBurnInput');
    let totalBurnTime = 1440;
    for(i = 0; i < totalBurnInput.length; i++){
        if(totalBurnInput[i].checked == true){
            totalBurnTime = totalBurnInput[i].value;
        }
    }
    console.log(totalBurnTime);
    console.log("request.php?cnn=" + chatName + "&mtmt=" + messageEncryptedMyPublicKey.cipher + "&mtyt=" + messageEncryptedReciverPublicKey.cipher);

    xhttp.open("GET", "request.php?cnn=" + chatName + "&mtmt=" + messageEncryptedMyPublicKey.cipher + "&mtyt=" + messageEncryptedReciverPublicKey.cipher + "&dt=" +  destructTime + "&bt=" + totalBurnTime, false);
    xhttp.send();
}

function deleteChat(chatName){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            responseText = this.responseText;
            getChats(); 
        }
        xhttp.open("GET", "request.php?dch=" + chatName, true);
        xhttp.send(); 
}
</script>
