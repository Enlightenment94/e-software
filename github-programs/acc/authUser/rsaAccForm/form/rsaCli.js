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
    var url = "rsa/rsaLogin.php";
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

            var codeString = "console.log('Hello, world!');";
            eval(codeString);
        }
    };
}

function register(){
    getPublicKey();
    var xmlhttp = new XMLHttpRequest();

    // określenie metody i adresu URL
    var url = "../rsa/rsaRegister.php";
    xmlhttp.open("POST", url, true);

    // określenie typu przesyłanych danych
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var email = document.getElementById('email').value;
    var captcha = document.getElementById('captcha').value;
    // przesłanie danych
    var data = "u=" + encodeURIComponent(encrypt(username)) + "&p=" + encodeURIComponent(encrypt(password)) + "&c=" + encodeURIComponent(encrypt(captcha)) + "&e=" + encodeURIComponent(encrypt(email));
    console.log(data);
    xmlhttp.send(data);

    // obsługa odpowiedzi serwera
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var el = document.getElementsByTagName("p");
            el[0].innerHTML = this.responseText;
            console.log(this.responseText);
        }
    };    
}