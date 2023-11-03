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

this.addEventListener('message', function(e) {
    switch(e.data) {
        case 'start':
            this.postMessage('watek uruchomiony!');
            setInterval(getMessages, 5000);
            break;
        case 'stop':
            this.postMessage('watek zatrzymany!');
            this.close(); // zatrzymanie skryptu wewnatrz watku roboczego
            break;
        default:
            this.postMessage('nieznane polecenie!');
    }
}, false);
