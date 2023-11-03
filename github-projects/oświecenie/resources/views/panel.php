<html>
<style>
#logo {
    border-radius: 50%;
    border: 3px solid #FFFF00;
    animation: swirl 2s infinite linear;
}

@keyframes swirl {
    0% {
        transform: rotateY(0) rotateX(0) rotateZ(0);
        box-shadow: 0 0 0 0 #FFFF00;
        opacity: 0;
    }
    50% {
        transform: rotateY(360deg) rotateX(360deg) rotateZ(360deg);
        opacity: 1;
        box-shadow: 0 0 0 20px rgba(255, 255, 0, 0);
    }
    100% {
        transform: rotateY(0) rotateX(0) rotateZ(0);
        box-shadow: 0 0 0 20px rgba(255, 255, 0, 0);
        opacity: 0;
    }
}

#webDescription{

}

#content{
    width: 420px;
    margin: 0 auto;
}

#insert{
    display: none;
}
</style>

<script>
function show(id) {
  var element = document.getElementById(id);
  
  if (element.style.display === "block") {
    element.style.display = "none";
  } else {
    element.style.display = "block";
  }

}
</script>

<?php
require_once('login.php');
?>

<body>
    <div id='head'>
        <center>
            <img id='logo' src='logo.jpg' width='100' height='100'/>
            <div id='webDescription'></div>
        </center>
    </div>

    <?php
    $GLOBALS["perfix"] = "articles_";
    require_once ('../public/la-config.php');
    ?>

    <div id='content'>
        <h1>Tags:</h1>
        <div id='tags'>
        <?php
        require_once('tagsMgr.php');
        $arrTags = selcetTable("tags");
        ?>         
        </div>
        
        <center><button onclick='show("insert")'>add</button></center>
        <form id='insert' action='i-rec' method='get'>
            <?php 

            //$tagsChecked = getPostTags($el["id"]);

            foreach ($arrTags as $tag) {
            ?>
                <input type="checkbox" name="tags[]" value="<?php echo $tag['name']; ?>" /> 
                <?php echo $tag['name']; ?>
                </label>       
            <?php } ?>
            </br>
            Title:
            <textarea class='title-area' name='t'></textarea>
            Subtitle:
            <textarea class='subtitle-area' name='st'></textarea>
            Description:
            <textarea class='description-area' name='d'></textarea>
            <input type='submit' value='insert'/>
        </form>

        <a href='logout'>logout</a>

        <h1>Posts:</h1>
        <div id='posts'>
        <?php
        require_once('postLiner.php');
        ?>
        </div>
    </div>
</body>
</html>