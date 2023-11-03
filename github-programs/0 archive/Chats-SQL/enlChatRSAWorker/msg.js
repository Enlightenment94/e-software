function read(id, chatName){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var responseText = this.responseText;
        }
        //console.log("request.php?gc=" + chatName);
        console.log("request.php?gcc=" + chatName + "&mi=" +  id);
        xhttp.open("GET", "request.php?gcc=" + chatName + "&mi=" +  id, true);
        xhttp.send(); 
}


function getMessages(pharseKey, chatName, worker){  
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var responseText = this.responseText;
            
            var rsaKey = cryptico.generateRSAKey(pharseKey, 1024);
            var txt = "";
            usernameArr = cutAll(responseText, "<username>", "</username>");
            messageArr = cutAll(responseText, "<message>", "</message>");
            burnTimeArr = cutAll(responseText, "<burn_time>", "</burn_time>");
            msgIdArr = cutAll(responseText, "<msg_id>", "</msg_id>");
            readTimeArr = cutAll(responseText, "<read_time>", "</read_time>");
            console.log("Length read time : " + readTimeArr.length);
            
            var i;
            var replace;
            for(i = 0; i < usernameArr.length; i++){
/*                  
*/
                //console.log("read time: " + readTimeArr[i]);
                if(readTimeArr[i] == ""){
                    //console.log(readTimeArr[i]);
                    txt += "<div onclick=\"read(\'" + msgIdArr[i] + "\',\'" + chatName + "\')\" style=' background-color: rgba(205, 205, 205, 0.5); margin: 3px; border-radius: 10px 10px 10px 10px; padding: 5px; text-align: center; padding-top: 15px; hover: color:red; '>click"; 
                    txt += "<div style='font-size: 8px;'>Total burn " + burnTimeArr[i] + "</div>";
                    txt +="</div>";
                }else{
                    txt += "<div style='background-color: rgba(205, 205, 205, 0.5); margin: 3px; border-radius: 0px 10px 20px 10px; padding: 5px;'>";
                    txt += "<div style='font-size: 16px; font-weight: 900; color: rgba(105, 255, 105, 0.6); text-shadow: 1px 1px rgb(105 205 105 / 60%'>" + usernameArr[i] + "</div>";
                    replace = messageArr[i].replaceAll(" ", "+");
                    temp = cryptico.decrypt(replace, rsaKey);
                    txt += temp.plaintext;
                    txt += "<div style='text-align: right; font-weight: bold; padding-bottom: 2px; padding-top: 2px; font-size: 10px; color: red; text-shadow: 0px -2px 4px #fff, 0px -2px 10px #FF3, 0px -10px 20px #F90, 0px -20px 40px;'>Burn in " + readTimeArr[i] + "</div>";
                    txt += "</div>";
                }
            }
            worker.postMessage(txt);
            //console.log(txt);
        }
        console.log("request.php?gc=" + chatName);
        xhttp.open("GET", "request.php?gc=" + chatName, true);
        xhttp.send();    
}

