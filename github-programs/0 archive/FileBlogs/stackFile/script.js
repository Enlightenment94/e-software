function clickCollapse(i){
    console.log("click!");
    content = document.getElementsByClassName("content");
    
    console.log(i);
    console.log(content.length);    
    if (content[i].style.display === "block") {
        ar = document.getElementById("ar");
        console.log(ar);
        if (typeof(ar) == 'undefined' || ar == null){
            content[i].style.display = "none";
        }else{

        }
    } else {
        content[i].style.display = "block";
    }
}

function clickEdit(i, p){
    content = document.getElementsByClassName("content");
    console.log(i);
    console.log(content.length);
    
    form = "<p><form id='editer' action='./panel.php' method='POST'><input type='text' name='p' value='" + p + "'/><input type='submit' name='ae' value='edit'/><input type='submit' name='rn' value='rename'/><input type='submit' name='d' value='delete'/></form>";

    if (content[i].style.display === "block") {
        ar = document.getElementById("ar");
        if (typeof(ar) == 'undefined' || ar == null){

        }else{
            ar = document.getElementById("ar").value;
            content[i].innerHTML = "<pre>" + ar + "</pre>";
            content[i].style.display = "none";
        }
    } else {
        content[i].style.display = "block";
        form += "<textarea id='ar' class='txtarea' form='editer' name='tx'>" + content[i].childNodes[0].innerHTML + "</textarea></p>";
        content[i].innerHTML = form;
    }
}

window.onload = function() {
    var coll = document.getElementsByClassName("collapsible");
    var eBtn = document.getElementsByClassName("editBtn");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", clickCollapse.bind(null, i), false);
        eBtn[i].addEventListener("click", clickEdit.bind(null, i, coll[i].innerText), false);
    }
}
