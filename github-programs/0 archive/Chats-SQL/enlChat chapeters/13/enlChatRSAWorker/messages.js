self.importScripts('js/cryptoico/jsbn.js');
self.importScripts('js/cryptoico/random.js'); 
self.importScripts('js/cryptoico/hash.js'); 
self.importScripts('js/cryptoico/rsa.js'); 
self.importScripts('js/cryptoico/aes.js'); 
self.importScripts('js/cryptoico/api.js'); 

function cut(testStr, startStr, endStr, enter){
    var result = "";

    var correct = 0;
    var i,j;

    var start = -1;
    var end = -1;
    for(i = enter; i < testStr.length; i++){
        if(testStr[i] == startStr[j]){
            if(correct == startStr.length - 1){
                start = i - startStr.length + 1;
                end = i + 1;
                break;                
            }
            correct++;
            j++;
        }else{
            correct = 0;        
            j = 0;
        }
    }

    var startEndStr = -1;
    var endEndStr = -1;
    j = 0;
    for(i = end; i < testStr.length; i++){
        if(testStr[i] == endStr[j]){
            if(correct == endStr.length - 1){
                startEndStr = i - endStr.length + 1;
                endEndStr = i + 1;
                break;                
            }
            correct++;
            j++;
        }else{
            correct = 0;        
            j = 0;
        }
    }

    return Array(start, end, startEndStr, endEndStr, i);
}

function cutAll(testStr, startStr, endStr){
    var k = 0;
    var arr;
    var enter = 0;
    var resultArr = new Array();
    var z = 0;
    for(k = 0; k < testStr.length; k++){
        arr = cut(testStr, startStr, endStr , enter);
        enter = arr[4];
        if(arr[0] == -1 || arr[2] == -1 ){
            break;
        }
        resultArr[z] = testStr.substring(arr[1], arr[2]);
        z++;
    }
    return resultArr;
}


function getMessages(pharseKey, chatName, worker){  
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var responseText = this.responseText;
            
            var rsaKey = cryptico.generateRSAKey(pharseKey, 1024);
            var txt = "";
            usernameArr = cutAll(responseText, "<username>", "</username>");
            messageArr = cutAll(responseText, "<message>", "</message>");
            destructTimeArr = cutAll(responseText, "<destruct_time>", "</destruct_time>");
            var i;
            var replace;
            for(i = 0; i < usernameArr.length; i++){
                txt += "<div style='background-color: rgba(205, 205, 205, 0.5); margin: 3px; border-radius: 0px 10px 20px 10px; padding: 5px;'>";
                txt += "<div style='font-size: 16px; font-weight: 900; color: rgba(105, 255, 105, 0.6); text-shadow: 1px 1px rgb(105 205 105 / 60%'>" + usernameArr[i] + "</div>";
                replace = messageArr[i].replaceAll(" ", "+");
                temp = cryptico.decrypt(replace, rsaKey);
                txt += temp.plaintext;
                txt += "<div style='text-align: right; font-weight: bold; padding-bottom: 2px; padding-top: 2px; font-size: 10px; color: red; text-shadow: 0px -2px 4px #fff, 0px -2px 10px #FF3, 0px -10px 20px #F90, 0px -20px 40px;'>Burn in " + destructTimeArr[i] + "</div>";
                txt += "</div>";
            }
            worker.postMessage(txt);
            //console.log(txt);
        }
        console.log("request.php?gc=" + chatName);
        xhttp.open("GET", "request.php?gc=" + chatName, true);
        xhttp.send();    
}

this.addEventListener('message', function(e) {

    switch(e.data) {
        case 'start':
            this.postMessage('watek uruchomiony!');
            break;
        case 'stop':
            this.postMessage('watek zatrzymany!');
            this.close();
            break;
    }
    if(Array.isArray(e.data)){
        var i = 0;
        for(i = 0; i < e.data.length; i++){
            console.log(e.data[i]);
        }
        console.log("LoL: " + e.data[0] + " " + e.data[1]);
        //for(;;){
        getMessages(e.data[0], e.data[1], this);
        setInterval(() => {
            console.log(e.data[0].substring(0, e.data[0].length - 1));
            getMessages(e.data[0], e.data[1], this);
        }, 5000);
    }
}, false);
