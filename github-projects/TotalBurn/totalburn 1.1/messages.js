self.importScripts('js/cryptoico/jsbn.js');
self.importScripts('js/cryptoico/random.js'); 
self.importScripts('js/cryptoico/hash.js'); 
self.importScripts('js/cryptoico/rsa.js'); 
self.importScripts('js/cryptoico/aes.js'); 
self.importScripts('js/cryptoico/api.js');
self.importScripts('msg.js');

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

    //console.log(end, startEndStr);
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
        if( (arr[1]+1) > arr[2] ){
            resultArr[z] = "";
            //console.log("1+1 " + arr[1] + " " + arr[2]);
        }else{
            resultArr[z] = testStr.substring(arr[1], arr[2]);
            //console.log(resultArr[z] + " " + arr[1] + " " + arr[2]);
        }
        z++;
    }
    return resultArr;
}

this.addEventListener('message', function(e) {

    switch(e.data) {
        case 'start':
            this.postMessage('watek uruchomiony!');
            break;
        case 'stop':
            //this.postMessage('watek zatrzymany!');
            this.close();
            break;
        case 'scroll':
            this.postMessage('scroll');
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
