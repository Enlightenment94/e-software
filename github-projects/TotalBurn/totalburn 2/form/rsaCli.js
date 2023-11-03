function getPublicKey(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        $publicKey = this.responseText;
        console.log($publicKey);
        document.getElementById('temp').innerHTML = $publicKey;
    }
    xhttp.open("GET", "../rsa/public.key", false);
    xhttp.send();   
}

function encrypt(plainText){
    var publicKey = document.getElementById('temp').innerHTML;
    var jse = new JSEncrypt();
    jse.setKey(publicKey);
    var encrypted = jse.encrypt(plainText);
    return encrypted
}

function getPublicKeyLogin(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        $publicKey = this.responseText;
        console.log($publicKey);
        document.getElementById('temp').innerHTML = $publicKey;
    }
    xhttp.open("GET", "rsa/public.key", false);
    xhttp.send();   
}

function login(){
    getPublicKeyLogin();
    var xmlhttp = new XMLHttpRequest();

    // określenie metody i adresu URL
    var url = "rsa/rsaRequest.php";
    xmlhttp.open("POST", url, true);

    // określenie typu przesyłanych danych
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var captcha = document.getElementById('captcha').value;
    
    // przesłanie danych
    var data = "u=" + encodeURIComponent(encrypt(username)) + "&p=" + encodeURIComponent(encrypt(password)) + "&c=" + encodeURIComponent(encrypt(captcha));
    console.log(data);
    xmlhttp.send(data);

    // obsługa odpowiedzi serwera
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // wykonanie akcji po otrzymaniu odpowiedzi
            var el = document.getElementsByTagName("p");
            el[0].innerHTML = this.responseText;
            console.log(this.responseText);
            eval(this.responseText);
        }
    };
}

function register(){
    getPublicKey();
    var xmlhttp = new XMLHttpRequest();

    // określenie metody i adresu URL
    var url = "../rsa/rsaRequest.php";
    xmlhttp.open("POST", url, true);

    // określenie typu przesyłanych danych
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var publicKey = document.getElementById('pubArea').value;
    var captcha = document.getElementById('captcha').value;
    // przesłanie danych
    var data = "u=" + encodeURIComponent(encrypt(username)) + "&p=" + encodeURIComponent(encrypt(password)) + "&c=" + encodeURIComponent(encrypt(captcha)) + "&pk=" + encodeURIComponent(publicKey);
    console.log(data);
    xmlhttp.send(data);

    // obsługa odpowiedzi serwera
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var el = document.getElementsByTagName("p");
            el[0].innerHTML = this.responseText;
            console.log(this.responseText);
            //eval(this.responseText);
        }
    };    
}


//self.importScripts('../lib/cryptoico/jsbn.js');
//self.importScripts('../lib/cryptoico/random.js'); 
//self.importScripts('../lib/cryptoico/hash.js'); 
//self.importScripts('../lib/cryptoico/rsa.js'); 
//self.importScripts('../lib/cryptoico/aes.js'); 
//self.importScripts('../lib/cryptoico/api.js');
//self.importScripts('msg.js');

function findUser() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var responseText = this.responseText;
        //console.log(responseText);
        var txt = "";
        var parser = new DOMParser();
        xmlDoc = parser.parseFromString(responseText, "text/xml")
        var usernames = xmlDoc.getElementsByTagName("username");
        console.log(responseText)
        txt = "<div>";
        for (i = 0; i < usernames.length; i++) {
            txt += "<div>";
            txt += "<button class='button-chat' onclick='createChat(\"" + usernames[i].childNodes[0].nodeValue + "\")'>" + usernames[i].childNodes[0].nodeValue; + "</button></div>";
            txt += "</div>";
        }
        txt += "</div>";
        document.getElementById("content").innerHTML = txt;
        console.log(txt);
    }

    elValue = document.getElementById("findInput").value;
    xhttp.open("GET", "../rsa/rsaRequest.php?fu=" + encodeURIComponent(encrypt(elValue), true));
    xhttp.send();
}

function createChat(username) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("content").innerHTML = this.responseText;
    }

    xhttp.open("GET", "../rsa/rsaRequest.php?ch=t&u=" + encodeURIComponent(encrypt(elValue), true), true);
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

    xhttp.open("GET", "../rsa/rsaRequest.php?gch=t", true);
    xhttp.send();
}

function deleteChat(chatName){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        responseText = this.responseText;
        getChats(); 
        console.log(responseText);
    }
    xhttp.open("GET", "../rsa/rsaRequest.php?dch=" + encodeURIComponent(encrypt(chatName), true), true);
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
        var pharseKey = document.getElementById('pharseInput').value;
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
        console.log(responseText);

        var chatName = xmlDoc.getElementsByTagName("chatName")[0].childNodes[0].nodeValue;
        var myPublicKey = xmlDoc.getElementsByTagName("myPublicKey")[0].childNodes[0].nodeValue;
        var reciverPublicKey = xmlDoc.getElementsByTagName("reciverPublicKey")[0].childNodes[0].nodeValue;


        var keys  = "<div style='margin: 4px;'><span class='color'>Sender: </span><div id='myPublicKey'>" + myPublicKey + "</div></div>";  
        keys += "<div style='margin: 4px;'><span class='color'>Reciver: </span><div id='reciverPublicKey'>" + reciverPublicKey + "</div></div>";
        keys += "<div style='margin: 4px;'><span class='color' style='font-weight: bold;'>ChatName: </span><div id='chatName'>" + chatName + "</div></div>";
        var chat = "";
        chat += "<div id='window'></div>";
        chat += "<input class='col75' id='message' type='text' value='Example'/>";
        chat += "<button class='col25' onclick='sendMessage()'>send</button>";
        document.getElementById("chat").innerHTML = chat;
        document.getElementById("chatKeys").innerHTML = keys;
        if(worker != null){
            worker.postMessage('stop');
        }
        workerUp();
    }

    xhttp.open("GET", "../rsa/rsaRequest.php?cn=" + encodeURIComponent(encrypt(chatName), false));
    xhttp.send();
}

function sendMessage(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        worker.postMessage('stop');
        workerUp();
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
    console.log("../rsa/rsaRequest.php?cnn=" + chatName + "&mtmt=" + messageEncryptedMyPublicKey.cipher + "&mtyt=" + messageEncryptedReciverPublicKey.cipher + "&dt=" +  destructTime + "&bt=" + totalBurnTime);

    xhttp.open("GET", "../rsa/rsaRequest.php?cnn=" + chatName + "&mtmt=" + messageEncryptedMyPublicKey.cipher + "&mtyt=" + messageEncryptedReciverPublicKey.cipher + "&dt=" +  destructTime + "&bt=" + totalBurnTime, false);
    xhttp.send();
}
