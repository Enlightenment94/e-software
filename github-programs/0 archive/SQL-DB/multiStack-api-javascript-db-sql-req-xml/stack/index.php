<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//    <canvas id="matrix"></canvas>
?>
<html>
    <head>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="css/js-style.css">
    </head>
<body>
    <div id='banner'>
        <center><img id='logo' width='150' height='150' src='logo.jpeg' /></center>
    </div>
    <div id='body'>
        <div id='add'>
            <center>
            <div id='menu'>
                <button onclick='showAddStack()' id="addStackButton">stacks</button>
                <button onclick='showAddTag()' id="addTagButton">tags</button>
                <button onclick='showAddRecord()' id="addRecordButton">add</button>
                <button onclick='showAddBackup()'>show bp</button>
                <button onclick='backup()' id="backupButton">backup</button>
            </div>
            </center>
            <div id='addStack'>
                <div id='stacks'></div>
                <input id='stack' type='text' value='stacker' name='tag' />
                <button onclick='addStack()'>stacks</button>
            </div>
            <div id='addTag'>
                <div>Tag:</div>
                <div id='tags'></div>
                <div>
                    <input id='tag' type='text' value='example' name='tag' />
                    <button onclick='addTag()'>add</button>
                </div>
            </div>
            <div id='addRecord'>
                <div id='addTags'></div>
                <div>Header:</div>
                <div><textarea id='headerNote'></textarea></div>
                <div>Note:</div>
                <div><textarea id='note'></textarea></div>
                <button onclick='addRecord()'>add</button>
            </div>
        </div>
        <div id='backups'></div>
        <div id='stacksList'></div>
        <center><div id='tagsList'></div></center>
        <center><button onclick='showRecordsByTags()'>show</button></center>
        <div id='content'></div>
        <div id='temp' style='display: none;'></div>
    </div>    

<script>
function deleteRecord(id){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        showRecords();
    }
    var req = "request.php?delete=" + id;
    console.log(req);
    xhttp.open("GET", req, true);
    xhttp.send();
}

var flagAddBackup = 1;
function showAddBackup(){
    if(flagAddBackup == 0){
        document.getElementById('backups').style.display = "none";
        flagAddBackup = 1;
    }else{
        showBackup();
        document.getElementById('backups').style.display = "block";
        flagAddBackup = 0;
    }
}

function showBackup(){
    console.log("showBackUp");
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        console.log("EHHH");
        console.log("response: " + this.responseText);
        document.getElementById('backups').innerHTML = this.responseText;
    }
    xhttp.open("GET", "request.php?gbp='t'", true);
    xhttp.send();
}

function backup(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        
    }
    xhttp.open("GET", "request.php?bp=t", true);
    xhttp.send();
}

function edit(id){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        //document.getElementById('response').innerHTML = this.response;
        showRecords();
    }
    var tags = document.getElementsByClassName('tagsEdit' + id);
    var tagsRequest = "", i;
    for(i=0; i < tags.length; i++){
        if(tags[i].checked){
            console.log(i +' checked ' + tags[i].checked);
            tagsRequest += "&tags2%5B%5D=" + tags[i].value;
        }
    }
    console.log( "KLAŁAL LUMPU" + tagsRequest);
    var header = document.getElementById("eh" + id).value;
    var text = document.getElementById("eho" + id).value;
    header = encodeURI(header); 
    text = encodeURI(text); 
    var req = "request.php?id2=" + id + "&header2=" + header + "&text2=" + text + tagsRequest;
    console.log("REQ after encode: " + req);
    xhttp.open("GET", req, false);
    xhttp.send();
}

function showEdit(el){
    console.log(el);
    console.log(document.getElementById(el).style.display);
    if(document.getElementById(el).style.display == "block"){
        document.getElementById(el).style.display = "none";
    }else{
        document.getElementById(el).style.display = "block";
    }
}

function showOptionalText(el){
    console.log(el);
    console.log(document.getElementById(el).style.display);
    if(document.getElementById(el).style.display == "block"){
        document.getElementById(el).style.display = "none";
    }else{
        document.getElementById(el).style.display = "block";
    }
}

function getNoteTags(noteId){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById('temp').innerHTML = this.responseText;
    }
    var req = "request.php?getTagsNote=" + noteId;
    console.log("getNoteTags(noteId): " + req);
    xhttp.open("GET", req, false);
    xhttp.send();
}

function tagsEditList() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var parser = new DOMParser();
        xmlDoc = parser.parseFromString(this.responseText, "text/xml")
        var tag = xmlDoc.getElementsByTagName("tag");
        
        var txt = "";
        var x, i, z;
        var els = document.getElementsByClassName('editTags');
        var noteId = document.getElementsByClassName("noteId");
        var temp = "";
        var flagNotChecked = 0;
        for(x = 0 ; x < els.length; x++ ){
            txt = "";
            getNoteTags(noteId[x].innerHTML); //tags in temp
            temp = document.getElementById("temp").innerHTML;
            console.log("tagsEditList() temp " + temp);
            xmlDoc = parser.parseFromString(temp, "text/xml");
            var checkedTags = xmlDoc.getElementsByTagName("tag");            
            flagNotChecked = 0;
            for(i = 0; i < tag.length;++i){
                for(z = 0; z < checkedTags.length; ++z){
                    if(tag[i].childNodes[0].nodeValue == checkedTags[z].childNodes[0].nodeValue){
                        txt += "<label class=''>" + tag[i].childNodes[0].nodeValue; 
                        txt += "<input class='tagsEdit"+ noteId[x].innerHTML +"' checked type='checkbox' value='" + tag[i].childNodes[0].nodeValue + "' name='tags[]' />";
                        txt += "</label>";
                        flagNotChecked = 1;
                        break;                        
                    }
                    flagNotChecked = 0;
                }
                if(flagNotChecked == 0){
                    txt += "<label class=''>" + tag[i].childNodes[0].nodeValue; 
                    txt += "<input class='tagsEdit" + noteId[x].innerHTML + "' type='checkbox' value='" + tag[i].childNodes[0].nodeValue + "' name='tags[]' />";
                    txt += "</label>";
                }
            }

            document.getElementById('temp').innerHTML
            els[x].innerHTML = txt;
        }
    }
    var req = "request.php?tag=t";
    console.log("tagsEditList() " + req);
    xhttp.open("GET", req, false);
    xhttp.send();
}

function showRecords(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var responseText = this.responseText;
        var parser = new DOMParser();
        var xmlDoc = parser.parseFromString(responseText, "text/xml")
        var noteId = xmlDoc.getElementsByTagName("note_id");
        var note = xmlDoc.getElementsByTagName("note");
        var otxt = xmlDoc.getElementsByTagName("otxt");
        var date = xmlDoc.getElementsByTagName("date");
        var txt = "<div class='post'>";
        //console.log("Global: " + tagsEdit);
        for (i = 0; i < note.length; i++) {
            txt += "<div style='width: 70%; float: left;'>";

            txt += "<div class='noteId'>" + noteId[i].childNodes[0].nodeValue + "</div>";
            txt += "<div class='postHedaer' onclick='showOptionalText(\"o" + noteId[i].childNodes[0].nodeValue + "\")' >" + note[i].childNodes[0].nodeValue + "</div>";
            txt += "<div class='optionalText' id='o"+ noteId[i].childNodes[0].nodeValue +"'>" 
                    + "<pre>"
                    +  otxt[i].childNodes[0].nodeValue 
                    + "</pre>"
                    + "</div>";

            txt += "<div id='e"+ noteId[i].childNodes[0].nodeValue + "' class='editWindow'>";
            txt += "<div><textarea id='eh" + noteId[i].childNodes[0].nodeValue + "'>" + note[i].childNodes[0].nodeValue + "</textarea></div>";
            txt += "<div class='editTags'></div>";
            txt += "<div><textarea id='eho" + noteId[i].childNodes[0].nodeValue + "'>" + otxt[i].childNodes[0].nodeValue + "</textarea></div>";
            txt += "<button onclick='edit(\"" + noteId[i].childNodes[0].nodeValue + "\")'>edit</button>";
            txt += "</div>";

            txt += "</div>";

            txt += "<div style='width: 7%; float: left;'>"
            txt += "<button id='" + noteId[i].childNodes[0].nodeValue + "' class='edit-button' onclick='showEdit(\"e" + noteId[i].childNodes[0].nodeValue + "\")'>edit</button>";
            txt += "</div>";

            txt += "<div style='width: 15%; float: left;'>"
            txt += "<div><center>" + date[i].childNodes[0].nodeValue + "</center></div>";    
            txt += "</div>";

            txt += "<div style='width: 7%; float: left;'>"
            txt += "<button onclick='deleteRecord(\""+ noteId[i].childNodes[0].nodeValue + "\")'>" + "del" + "</button>";    
            txt += "</div>";
        }
        txt += "</div>";
        document.getElementById("content").innerHTML = txt;
        console.log("I am herr " + txt);
        tagsEditList();
    }
    var req = "request.php?selectAll=t";
    console.log("showRecords() " + req);
    xhttp.open("GET", req, false);
    xhttp.send();
}

function showRecordsByTags(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var responseText = this.responseText;
        var parser = new DOMParser();
        var xmlDoc = parser.parseFromString(responseText, "text/xml")
        var noteId = xmlDoc.getElementsByTagName("note_id");
        var note = xmlDoc.getElementsByTagName("note");
        var otxt = xmlDoc.getElementsByTagName("otxt");
        var date = xmlDoc.getElementsByTagName("date");
        var txt = "<div class='post'>";
        //console.log("Global: " + tagsEdit);
        for (i = 0; i < note.length; i++) {
            txt += "<div style='width: 75%; float: left;'>";

            txt += "<div class='noteId'>" + noteId[i].childNodes[0].nodeValue + "</div>";
            txt += "<div class='postHedaer' onclick='showOptionalText(\"o" + noteId[i].childNodes[0].nodeValue + "\")' >" + note[i].childNodes[0].nodeValue + "</div>";
            txt += "<div class='optionalText' id='o"+ noteId[i].childNodes[0].nodeValue +"'>" 
                    + "<pre>" + otxt[i].childNodes[0].nodeValue + "</pre>"
                    + "</div>";

            //edit
            //eha
            //eh
            txt += "<div id='e"+ noteId[i].childNodes[0].nodeValue + "' class='editWindow'>";
            txt += "<div><textarea id='eh" + noteId[i].childNodes[0].nodeValue + "'>" + note[i].childNodes[0].nodeValue + "</textarea></div>";
            txt += "<div class='editTags'></div>";
            txt += "<div><textarea id='eho" + noteId[i].childNodes[0].nodeValue + "'>" + otxt[i].childNodes[0].nodeValue + "</textarea></div>";
            txt += "<button onclick='edit(\"" + noteId[i].childNodes[0].nodeValue + "\")'>edit</button>";
            txt += "</div>";

            txt += "</div>";

            txt += "<div style='width: 5%; float: left;'>"
            txt += "<button id='" + noteId[i].childNodes[0].nodeValue + "' class='edit-button' onclick='showEdit(\"e" + noteId[i].childNodes[0].nodeValue + "\")'>edit</button>";
            txt += "</div>";

            txt += "<div style='width: 15%; float: left;'>"
            txt += "<div>" + date[i].childNodes[0].nodeValue + "</div>";    
            txt += "</div>";

            txt += "<div style='width: 5%; float: left;'>"
            txt += "<button onclick='deleteRecord(\""+ noteId[i].childNodes[0].nodeValue + "\")'>" + "del" + "</button>";    
            txt += "</div>";
        }
        txt += "</div>";

        document.getElementById("content").innerHTML = txt;
        console.log("showRecordsByTags() " + txt);
        tagsEditList();
    }

    var req = "request.php?";
    var el = document.getElementsByClassName('tags-checkbox');
    var i = 0;
    var flagFirst = 0;
    for(i=0 ; i< el.length; i++){
        if(el[i].checked){
            if(flagFirst == 0){
                req += "selectByTag%5B%5D=" + el[i].value;
                flagFirst = 1;
            }else{
                req += "&selectByTag%5B%5D=" + el[i].value;
            }
        }
    }
    
    console.log(req);
    xhttp.open("GET", req, false);
    xhttp.send();
}

function tagsList() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var responseText = this.responseText;
        var parser = new DOMParser();
        xmlDoc = parser.parseFromString(responseText, "text/xml")
        var tag = xmlDoc.getElementsByTagName("tag");
        txt = "<div>";
        for (i = 0; i < tag.length; i++) {
            txt += "<label>";
            txt += "<input class='tags-checkbox' type='checkbox' value='" +  tag[i].childNodes[0].nodeValue + "'>";
            txt += "<span>" + tag[i].childNodes[0].nodeValue + "</span>";
            txt += "</label>";
        }
        txt += "</div>";
        document.getElementById("tagsList").innerHTML = txt;
        console.log("tagsList() txt " + txt);
    }
    var req = "request.php?tag=t";
    console.log("tagsList() " + req);
    xhttp.open("GET", req, false);
    xhttp.send();
}

function stacksList(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var responseText = this.responseText;
        var parser = new DOMParser();
        xmlDoc = parser.parseFromString(responseText, "text/xml")
        var stack = xmlDoc.getElementsByTagName("stack");
        txt = "<div>";
        for (i = 0; i < stack.length; i++) {
            txt += "<button class='stack-button button-base' onclick='setStack(\"" + stack[i].childNodes[0].nodeValue + "\")'>" + stack[i].childNodes[0].nodeValue +"</button>" 
        }
        txt += "</div>";
        console.log(txt);
        document.getElementById("stacksList").innerHTML = txt;
    }
    var req = "request.php?getStacks=t";
    console.log(req);
    xhttp.open("GET", req, true);
    xhttp.send();

}

function setStack(stack){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        tagsList();
        stacksList();
        getTags();
        getAddTags();
        showRecords();
    }
    var req = "request.php?setStack=" + stack;
    console.log(req);
    xhttp.open("GET", req, true);
    xhttp.send();
}

function getStacks(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var responseText = this.responseText;
        var parser = new DOMParser();
        xmlDoc = parser.parseFromString(responseText, "text/xml")
        var stack = xmlDoc.getElementsByTagName("stack");
        txt = "<div>";
        for (i = 0; i < stack.length; i++) {
            txt += "<div>";
            txt += "<button onclick='delStack(\"" + stack[i].childNodes[0].nodeValue + "\")'>del</button>" + stack[i].childNodes[0].nodeValue + "<button onclick='setStack(\"" + stack[i].childNodes[0].nodeValue + "\")'>set</button>" 
            txt += "</div>";
        }
        txt += "</div>";
        console.log(txt);
        document.getElementById("stacks").innerHTML = txt;
    }
    var req = "request.php?getStacks=t";
    console.log(req);
    xhttp.open("GET", req, true);
    xhttp.send();
}

function delStack(del){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var responseText = this.responseText;
        getStacks();
    }
    var req = "request.php?deleteStack=" + del;
    console.log(req);
    xhttp.open("GET", req, true);
    xhttp.send();
}

function addStack(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var responseText = this.responseText;
        showRecords();
    }
    var stack = document.getElementById('stack').value;
    var req = "request.php?stack=" + stack;
    console.log(req);
    xhttp.open("GET", req, true);
    xhttp.send();
}

function delTag(del){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var responseText = this.responseText;
        getTags();
    }
    var req = "request.php?delTag=" + del;
    console.log(req);
    xhttp.open("GET", req, true);
    xhttp.send();
}

function getTags() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var responseText = this.responseText;
        var parser = new DOMParser();
        xmlDoc = parser.parseFromString(responseText, "text/xml")
        var tag = xmlDoc.getElementsByTagName("tag");
        txt = "<div>";
        for (i = 0; i < tag.length; i++) {
            console.log("Helllo " + tag[i].childNodes[0].nodeValue);
            txt += "<div>";
            txt += "<button onclick='delTag(\"" + tag[i].childNodes[0].nodeValue + "\")'>del</button>" + tag[i].childNodes[0].nodeValue; 
            txt += "</div>";
        }
        txt += "</div>";
        document.getElementById("tags").innerHTML = txt;
        console.log(txt);
    }
    var req = "request.php?tag=t";
    console.log(req);
    xhttp.open("GET", req, true);
    xhttp.send();
}

var flagAddStack = 0;
function showAddStack(){
    if(flagAddStack == 0){
        document.getElementById('addStack').style.display = "none";
        flagAddStack = 1;
    }else{
        getStacks();
        document.getElementById('addStack').style.display = "block";
        flagAddStack = 0;
    }
}

var flagAddTag = 0;
function showAddTag(){
    if(flagAddTag == 0){
        document.getElementById('addTag').style.display = "none";
        flagAddTag = 1;
    }else{
        getTags();
        document.getElementById('addTag').style.display = "block";
        flagAddTag = 0;
    }
}

var flagAddRecord = 0;
function showAddRecord(){
    if(flagAddRecord == 0){
        document.getElementById('addRecord').style.display = "none";
        flagAddRecord = 1;
    }else{
        document.getElementById('addRecord').style.display = "block";
        flagAddRecord = 0;
    }
}

function addTag() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        getTags();
    }
    var tag = document.getElementById('tag').value;
    var req = "request.php?tag=" + tag +"&addTag=t";
    console.log(req);
    xhttp.open("GET", req, true);
    xhttp.send();
}

function getAddTags() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var parser = new DOMParser();
        xmlDoc = parser.parseFromString(this.responseText, "text/xml")
        var tag = xmlDoc.getElementsByTagName("tag");
        txt = "<div>";
        for (i = 0; i < tag.length; i++) {
            txt += "<label class=''>" + tag[i].childNodes[0].nodeValue; 
            txt += "<input class='tags' type='checkbox' value='" + tag[i].childNodes[0].nodeValue + "' name='tags[]' />";
            txt += "</label>";
        }
        txt += "</div>";
        document.getElementById("addTags").innerHTML = txt;
        console.log(txt);
    }
    var req = "request.php?tag=t";
    console.log(req);
    xhttp.open("GET", req, true);
    xhttp.send();
}

function addRecord() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        showRecords();
    }
    var tags = document.getElementsByClassName("tags");
    var tagsRequest = "", i;
    for(i=0; i < tags.length; i++){
        tagsRequest += "&tags%5B%5D=" + tags[i].value; //maybe to
    }
    var header = document.getElementById("headerNote").value;
    var text = document.getElementById("note").value;  
    header = encodeURI(header);
    text = encodeURI(text);
    var req = "request.php?header=" + header + "&text=" + text + tagsRequest;
    console.log("ADD RECORD REQUEST: " + req);
    xhttp.open("GET", req, true);
    xhttp.send();
}

window.onload = function(){
    //getAddTags();
    document.getElementById('addRecord').style.display = "none";
    document.getElementById('addStack').style.display = "none";
    document.getElementById('addTag').style.display = "none";
    document.getElementById('backups').style.display = "none";
    flagAddTag = 1;
    flagAddStack = 1;
    flagAddRecord = 1;

    stacksList();
    showBackup();
}



</script>  
</body>
</html>
