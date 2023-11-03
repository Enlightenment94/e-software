<style>
.post{
    background-color: rgba(205,205,205);
    padding-top: 5px;
}

.title{
    padding: 5px;
}

.text{
    background-color: rgba(235,235,235);
    display: none;
    padding: 5px;
    margin: 0px;
}

.title:hover{
    border: black 1px solid;
}
</style>

<script>
function show(){
    var vis = document.getElementById("p1")
    if(vis.style.display == "none"){
        vis.style.display = "block"
        console.log("block")
    }else{
        vis.style.display = "none"
    }
}
</script>

<div class='post'>
    <div class='title' onclick="show()">How are you?</div>
    <div id='p1' class='text'>I am be fine casue I am really exhousted.</div>
</div>
