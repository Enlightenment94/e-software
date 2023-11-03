this.addEventListener('message', function(e) {
    switch(e.data) {
        case 'start':
            this.postMessage('watek uruchomiony!');
            break;
        case 'stop':
            this.postMessage('watek zatrzymany!');
            this.close(); // zatrzymanie skryptu wewnatrz watku roboczego
            break;
        default:
            this.postMessage('nieznane polecenie!');
    }

    if(Array.isArray(e.data)){
        var i = 0;
        for(i = 0; i < e.data.length; i++){
            console.log(e.data[i]);
        }
    }
    
}, false);
