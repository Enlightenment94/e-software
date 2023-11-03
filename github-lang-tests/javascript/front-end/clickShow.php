<style>
.post{
}

.title{
}

.text{
    visibility: hidden;
}

.title:hover{
    border: black 1px solid;
}
</style>

<script>
function show(){
    var vis = document.getElementById("p1")
    if(vis.style.visibility == "hidden"){
        vis.style.visibility = "visible"
        console.log("visible")
    }else{
        vis.style.visibility = "hidden"
    }
}
</script>

<div class='post'>
    <div class='title' onclick="show()">How are you?</div>
    <div id='p1' class='text'>I am be fine casue I am really exhousted.</div>
</div>
