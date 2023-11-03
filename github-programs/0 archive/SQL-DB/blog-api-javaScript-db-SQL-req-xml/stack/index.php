<html>
    <head></head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleJS.css">
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

    <div id='contentPosts'> 
    </div>

    <div id='footer'>
        Load
        <p><?php echo date("d-m-y h:i:s");?></p>
    </div>
</body>

<script>
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
        for (i = postIds.length - 1; i >= 0; i--) {
            txt += "<div style='width: 100%;'>";
            txt += "<div style='display: none;' id='i"+ postIds[i].childNodes[0].nodeValue +"'>" + postIds[i].childNodes[0].nodeValue +"</div>";
            txt += "<div class='postHeader' style='width: 78%; float: left;' onclick='showPost(\"o" + postIds[i].childNodes[0].nodeValue + "\")'>" +  headers[i].childNodes[0].nodeValue + "</div>"
            txt += "<div style='text-align: center; width: 22%; float: left; padding-top: 10px; padding-bottom: 10px;'>" + date[i].childNodes[0].nodeValue + "</div>";
            txt += "<div style='display: none; width: 100%; float: left; padding-top: 5px; padding-bottom: 5px;' id='o" + postIds[i].childNodes[0].nodeValue + "'>" 
            + "<pre>" + posts[i].childNodes[0].nodeValue + "</pre>"
            + "</div>"

            txt += "</div>";
        }
        txt += "</div>";
        document.getElementById("contentPosts").innerHTML = txt;
    }
    xhttp.open("GET", "request.php?s=t", false);
    xhttp.send();
}

window.onload = function(){
    getPosts();
};
</script>
