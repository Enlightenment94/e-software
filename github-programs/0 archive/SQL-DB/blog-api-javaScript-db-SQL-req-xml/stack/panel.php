<html>
    <head>panel</head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleJS.css">
    <meta charset='utf-8'>
<body>
    <div style='margin: 0 auto; width: 2200px'>
        <canvas id="nokey" width='100%' height='100%'></canvas>
    </div>
    <script src='particle.js'></script>

    <div id='banner'>Created
        <p>03.07.2023</p>
    </div>
    <div style='height: 30px;'></div>
    <div id='header'>EnlightenmentSoftware</div>
    <div id='subHeader'>IT sector - web developer company</div>

    <div id='content'>
        <div id='image'>
            <a href='../esoftware'><img id='logo' src='logo.jpeg' width='100' height='100'/></a>
        </div>

        <div id='git'>
            <a href='https://github.com/Enlightenment94/e-software'>https://github.com/Enlightenment94/e-software</a>
        </div>

        <div id='about'>
        <center>"Programowanie przypomina skrzynkę narzędzi, a podręcznikiem w ich używaniu jest manual, z czasem uczymy się coraz szybciej ich korzystać, ale skrzynka jest na tyle skomplikowana, że powstały całe grona ludzi rozwiązujące problemy jak z jej korzystać."</center>
        </div>

        <div id='documentation'>
            <p><span style='color: white;'><strong>Documentations:</strong></span></p>
            <a href='https://stackoverflow.com/'>stackoverflow</a>
            <a href='https://www.php.net/manual/en/index.php'>php</a>
            <a href='https://www.w3schools.com/'>w3c</a>
            <a href='https://javascript.info/'>javascript</a>
            <a href='https://dev.mysql.com/doc/refman/8.0/en/'>MySql</a>
        </div>
    </div>

    <div id='addPosts'>
        <center>
                <button onclick='showAddWindow()' style='margin: 10px; padding: 5px; width: 50px;'>add</button>
                <button onclick='getBackUps()' style='margin: 10px; padding: 5px; width: 50px;'>show</button>
                <form style='display: inline;' action='request.php'>
                    <input type='submit' name='bp' value='bp' style='margin: 10px; padding: 5px; width: 50px;'/>
                </form>
        </center> 
        <div id='addWindow'>
            <div>Header:</div>
            <div style="padding-bottom: 10px; padding-top: 10px;"><textarea id='headerAdd'></textarea></div>
            <div>Post:</div>
            <div style="padding-bottom: 10px; padding-top: 10px;"><textarea id='postAdd'></textarea></div>
            <div><button onclick='sendPost()'>send</button></div>
        </div>
        <div id='backup'></div>
    </div>

    <div id='contentPosts'> 
    </div>

    <div id='footer'>
        Load
        <p><?php echo date("d-m-y h:i:s");?></p>
    </div>
</body>

<script>
var flagShowAdd = 0;
function showAddWindow(){
    var el = document.getElementById('addWindow');
    if(flagShowAdd == 0){
        el.style.display = "block";
        flagShowAdd = 1;
        console.log('block');
    }else{
        el.style.display = "none";
        flagShowAdd = 0;
        console.log('none');
    }
}

function showPost(elId){
    var el = document.getElementById(elId);
    if( el.style.display == "none"){
        el.style.display= "block";
    }else{
        el.style.display= "none";
    }
}

function show(elId){
    var el = document.getElementById(elId);
    if( el.style.display == "none"){
        el.style.display= "block";
    }else{
        el.style.display= "none";
    }
}

function backUp(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
    }
    xhttp.open("GET", "request.php?bp=t" , false);
    xhttp.send();
}

function getBackUps(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var parser = new DOMParser();
        xmlDoc = parser.parseFromString(this.responseText, "text/xml")
        var bps = xmlDoc.getElementsByTagName("bp");
        var i;
        var txt = "<div style='text-align: center; overflow: hidden;'>";
        for(i = 0; i < bps.length; i++ ){
            txt += "<div>";
            txt += "<a href='request.php?lbp=" + bps[i].childNodes[0].nodeValue + "'>" + bps[i].childNodes[0].nodeValue + "</a>";
            txt += "</div>";
        }
        txt += "</div>";
        document.getElementById("backup").innerHTML = txt;
    }
    xhttp.open("GET", "request.php?gbp=t" , false);
    xhttp.send();
}

function getPosts() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var responseText = this.responseText;
        var parser = new DOMParser();
        xmlDoc = parser.parseFromString(responseText, "text/xml")
        var postIds = xmlDoc.getElementsByTagName("post_id");
        var headers = xmlDoc.getElementsByTagName("header");
        var posts = xmlDoc.getElementsByTagName("post");
        var date = xmlDoc.getElementsByTagName("date");

        txt = "<div style='width: 800px; margin: 0 auto; padding: 20px; overflow: hidden;'>";
        for (i = 0; i < postIds.length; i++) {
            txt += "<div style='width: 100%;'>";
                txt += "<div style='display: none;' id='i"+ postIds[i].childNodes[0].nodeValue +"'>" + postIds[i].childNodes[0].nodeValue +"</div>";
                txt += "<div class='postHeader' style='width: 65%; float: left;' onclick='showPost(\"o" + postIds[i].childNodes[0].nodeValue + "\")'>" +  headers[i].childNodes[0].nodeValue + "</div>"
                txt += "<div style='width: 5%; float: left;'><button onclick='show(\"e" + postIds[i].childNodes[0].nodeValue + "\")'>edit</button></div>"
                txt += "<div style='text-align: center; width: 22%; float: left;'>" + date[i].childNodes[0].nodeValue + "</div>";
                txt += "<div style='width: 4%; float: left;'><button onclick='deletePost(\"" + postIds[i].childNodes[0].nodeValue + "\")'>del</button></div>"
                txt += "<div style='display: none; width: 100%; float: left; padding-top: 5px; padding-bottom: 5px;' id='o" + postIds[i].childNodes[0].nodeValue + "'>" 
                    + "<pre>" + posts[i].childNodes[0].nodeValue + "</pre>"
                + "</div>"

                + "<div style='display: none; width: 100%; float: left; padding-top: 5px; padding-bottom: 5px;' id='e" + postIds[i].childNodes[0].nodeValue + "'>"
                + "<div>Header:</div>"
                + "<div style='padding-bottom: 10px; padding-top: 10px;'><textarea style='width: 100%; height: 100px;' id='eh" + postIds[i].childNodes[0].nodeValue +"'>" +  headers[i].childNodes[0].nodeValue + "</textarea></div>"
                + "<div>Post:</div>"
                + "<div style='padding-bottom: 10px; padding-top: 10px;'><textarea style='width: 100%; height: 250px;' id='ep" + postIds[i].childNodes[0].nodeValue + "'>"+ posts[i].childNodes[0].nodeValue + "</textarea></div>"
                + "<div><button onclick='editPost(\"" + postIds[i].childNodes[0].nodeValue + "\")'>edit</button></div>";
                + "</div>";
            txt += "</div>";
        }
        txt += "</div>";
        //console.log(txt);
        document.getElementById("contentPosts").innerHTML = txt;
    }
    xhttp.open("GET", "request.php?s=t", false);
    xhttp.send();
}

function sendPost() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        getPosts();
    }

    var header = document.getElementById('headerAdd').value;
    var post = document.getElementById('postAdd').value;
    header = encodeURI(header);
    post = encodeURI(post);
    console.log("request.php?i=t&h=" + header + "&p=" + post);
    xhttp.open("GET", "request.php?i=t&h=" + header + "&p=" + post , false);
    xhttp.send();
}

function editPost(id) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        getPosts();
    }

    var eid = document.getElementById('e' + id).innerHTML;
    var header = document.getElementById('eh' + id).value;
    var post = document.getElementById('ep' + id).value;
    header = encodeURI(header);
    post = encodeURI(post);
    console.log("request.php?e=t&id=" + id +"&h=" + header + "&p=" + post);
    xhttp.open("GET", "request.php?e=t&id=" + id +"&h=" + header + "&p=" + post , false);
    xhttp.send();
}

function deletePost(id) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        getPosts();
    }
    
    var di = document.getElementById('i' + id).innerHTML;
    console.log("request.php?d=t&di=" + di);
    xhttp.open("GET", "request.php?d=t&di=" + di, false);
    xhttp.send();
}

window.onload = function(){
    getPosts();
};
</script>
