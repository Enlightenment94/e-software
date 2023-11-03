this.addEventListener('message', function(e) {
    switch(e.data) {
        case 'start':
            this.postMessage('watek uruchomiony!');
            document.getElementById('el').innerHTML = 'Not Okay';
            break;
        case 'stop':
            this.postMessage('watek zatrzymany!');
            this.close(); // zatrzymanie skryptu wewnatrz watku roboczego
            break;
        default:
            this.postMessage('nieznane polecenie!');
    }
}, false);
