function testAjax() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("response").innerHTML = this.responseText;
    }
    xhttp.open("GET", "request.php?testAjax=t", true);
    xhttp.send();
}

function getFriends() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("response").innerHTML = this.responseText;
    }
    xhttp.open("GET", "request.php?f=t", true);
    xhttp.send();
}

function searchFriend() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("response").innerHTML = this.responseText;
    }
    var searchFriend = document.getElementById("search_friend").value;
    xhttp.open("GET", "request.php?sf=" + searchFriend, true);
    xhttp.send();
}

function startChat(username){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("response").innerHTML = this.responseText;
    }
    xhttp.open("GET", "request.php?sc=" + username, true);
    xhttp.send();
}

function showChats(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("response").innerHTML = this.responseText;
    }
    xhttp.open("GET", "request.php?smc=t", true);
    xhttp.send();
}

function showWindowChat(el){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("response").innerHTML = this.responseText;
    }
    console.log(el);
    xhttp.open("GET", "request.php?swc=" + el, true);
    xhttp.send();
}

function sendMessage(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        //document.getElementById("response").innerHTML = this.responseText;
    }
    var publicKey = document.getElementById('publicKey').innerHTML;
    chatName = document.getElementById("chatName").innerHTML;
    message = document.getElementById("sendMessage").value;
    var encMessage = cryptico.encrypt(message, publicKey);
    xhttp.open("GET", "request.php?sm=" + encMessage.cipher  + "&cn=" + chatName, true);
    xhttp.send();
}

function getMessages(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("chatWindow").innerHTML = this.responseText;
    }
    chatName = document.getElementById("chatName").innerHTML;
    xhttp.open("GET", "request.php?gm=t&cn=" + chatName, true);
    xhttp.send();
}

var intervalId = window.setInterval(function(){
    console.log('Interval 5000');
    var element =  document.getElementById('chatWindow');
    if (typeof(element) != 'undefined' && element != null){
        getMessages();
    }
}, 5000);
