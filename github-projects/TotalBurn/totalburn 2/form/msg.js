function read(id, chatName){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var responseText = this.responseText;
        }
        //console.log("request.php?gc=" + chatName);
        console.log("../rsa/rsaRequest.php?gcc=" + chatName + "&mi=" +  id);
        xhttp.open("GET", "../rsa/rsaRequest.php?gcc=" + chatName + "&mi=" +  id, true);
        xhttp.send(); 
}


function getMessages(pharseKey, chatName, worker){  
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var responseText = this.responseText;
            
            var rsaKey = cryptico.generateRSAKey(pharseKey, 2048);
            var txt = "";

            /*
            usernameArr = cutAll(responseText, "<username>", "</username>");
            messageArr = cutAll(responseText, "<message>", "</message>");
            burnTimeArr = cutAll(responseText, "<burn_time>", "</burn_time>");
            msgIdArr = cutAll(responseText, "<msg_id>", "</msg_id>");
            readTimeArr = cutAll(responseText, "<read_time>", "</read_time>");
            console.log("Length read time : " + readTimeArr.length);*/

            const usernameArr = responseText.match(/<username>(.*?)<\/username>/g).map(function(val){
                return val.replace("<username>", "").replace("</username>", "");
            });
            const messageArr = responseText.match(/<message>(.*?)<\/message>/g).map(function(val){
                return val.replace("<message>", "").replace("</message>", "");
            });
            const burnTimeArr = responseText.match(/<burn_time>(.*?)<\/burn_time>/g).map(function(val){
                return val.replace("<burn_time>", "").replace("</burn_time>", "");
            });
            const msgIdArr = responseText.match(/<msg_id>(.*?)<\/msg_id>/g).map(function(val){
                return val.replace("<msg_id>", "").replace("</msg_id>", "");
            });
            const readTimeArr = responseText.match(/<read_time>(.*?)<\/read_time>/g).map(function(val){
                return val.replace("<read_time>", "").replace("</read_time>", "");
            });
            
            var i;
            var replace;
            for(i = 0; i < usernameArr.length; i++){
                //console.log("read time: " + readTimeArr[i]);
                if(readTimeArr[i] == ""){
                    //console.log(readTimeArr[i]);
                    txt += "<div class='burnButtonChat' onclick=\"read(\'" + msgIdArr[i] + "\',\'" + chatName + "\')\" style=' background-color: rgba(205, 205, 205, 0.0); margin: 3px; border-radius: 10px 10px 10px 10px; padding: 5px; text-align: center; padding-top: 15px; hover: color:red; '>click"; 
                    txt += "<div style='font-size: 8px; color: #FF4500;'>Total burn " + burnTimeArr[i] + "</div>";
                    txt +="</div>";
                }else{
                    txt += "<div style='background-color: rgba(205, 205, 205, 0.0); margin: 3px; border-radius: 0px 10px 20px 10px; padding: 5px;'>";
                    txt += "<div style='font-size: 16px; font-weight: 900; color: #FF4500; text-shadow: 1px 1px #FF4500;'>" + usernameArr[i] + "</div>";
                    replace = messageArr[i].replaceAll(" ", "+");
                    temp = cryptico.decrypt(replace, rsaKey);
                    txt += temp.plaintext;
                    txt += "<div style='text-align: right; font-weight: bold; padding-bottom: 2px; padding-top: 2px; font-size: 10px; color: #FF4500; text-shadow: 0px -2px 4px #fff, 0px -2px 10px #FF3, 0px -10px 20px #F90, 0px -20px 40px;'>Burn in " + readTimeArr[i] + "</div>";
                    txt += "</div>";
                }
            }
            worker.postMessage(txt);
            //console.log(txt);
        }
        console.log("../rsa/rsaRequest.php?gc=" + chatName);
        xhttp.open("GET", "../rsa/rsaRequest.php?gc=" + chatName, true);
        xhttp.send();    
}

