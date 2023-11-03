function clickCollapse(i){
    content = document.getElementsByClassName("content");
    
    console.log("click!");
    console.log(i);
    console.log(content.length);    
    if (content[i].style.display === "block") {
        content[i].style.display = "none";
    } else {
        content[i].style.display = "block";
    }
}

window.onload = function() {
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", clickCollapse.bind(null, i), false);
    }
}
