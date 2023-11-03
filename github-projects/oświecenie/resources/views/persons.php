<html>
<style>
body{
    margin: 0px;
    background-color: rgba(225, 225, 225, 0.4);

}
#head{
    background-color: rgba(235, 235, 235, 0.4);
}

#logo {
    border-radius: 50%;
    border: 3px solid #FFFF00;
    animation: halo 1s ease-in-out infinite;
}

@keyframes swirl {
    0% {
        transform: rotateY(0) rotateX(0) rotateZ(0);
        opacity: 0;
    }
    50% {
        transform: rotateY(360deg) rotateX(360deg) rotateZ(360deg);
        opacity: 1;
    }
    100% {
        transform: rotateY(0) rotateX(0) rotateZ(0);
        opacity: 0;
    }
}

@keyframes halo {
  0% {
    box-shadow: 0 0 0 0 #FFFF00;
  }
  50% {
    box-shadow: 0 0 0 20px rgba(255, 255, 0, 0);
  }
  100% {
    box-shadow: 0 0 0 20px rgba(255, 255, 0, 0);
  }
}
@keyframes halo2 {
  0% {
    box-shadow: 0 0 0 0 #00BFFF;
  }
  50% {
    box-shadow: 0 0 0 20px rgba(0, 191, 255, 0);
  }
  100% {
    box-shadow: 0 0 0 20px rgba(0, 191, 255, 0);
  }
}

#webDescription{
    padding: 10px;
    background-color: rgba(225, 225, 225, 0.4);
}

#content{
    width: 420px;
    margin: 0 auto;
    background-color: rgba(235, 235, 235, 0.4);
    padding: 10px;
    border: 1px;
    border-top: 1px groove #c0c0c0;
    border-left: 1px ridge #c0c0c0;

    border-right: 2px ridge #dcdcdc;
    border-bottom: 2px ridge #dcdcdc;
}

#insert{
    display: none;
}

form{
    padding: 0;
    margin: 0;
}
</style>

<style>
.title{
    background-color: rgba(225, 225, 225, 0.4);
    padding: 5px;
}

.title:hover{
    animation: halo2 1s ease-in-out infinite;
    cursor: pointer;
}

.subtitle{
    padding: 5px;
}

.description{
    padding: 5px;
    font-size: 12px;
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

<body>
    <div id='head'>
        <center>
            <a href='../public'>
                <img id='logo' src='logo.jpg' width='100' height='100'/>
            </a>
            <div style='height: 10px;'></div>
            <div id='webDescription'>"Patroni oświecenia i wybitni ludzie."</div>
        </center>
    </div>
    </br>

    <?php
    $GLOBALS["perfix"] = "persons_";
    require_once ('../public/la-config.php');
    ?>

    <div id='content'>
        <div id='posts'>
        <?php
        $arr = selcetTable("posts");
        ?>

        <?php
        if(isset($_GET['tg'])){
            $idsTagsArr = array();
            $tagsArr = $_GET['tg'];
            $temp = "";
            foreach($tagsArr as $el){
                $temp  = selectIdByTag($el);
                array_push($idsTagsArr, $temp);
            }
            $arr = getPostsByTags($idsTagsArr);
        }
        ?>

        <center>
        <form action='./persons' method='get'>
        <?php
        $arrTags = selcetTable("tags");
        foreach($arrTags as $tag){
        ?>
            <label>
            <input type='checkbox' name='tg[]' value='<?php echo $tag['name'];?>'>
            <?php echo $tag['name']; ?>
            </label>
        <?php }?>
            <br></br>
            <center><input type='submit' name='' value='show'></center>
        </form>
        </center>

        <?php foreach($arr as $el){ ?>
        <div class='post' id='post<?php $el['id'];?>'>
            <span style='visibility:hidden'><?php echo $el['id']; ?></span>

            <div class='col100'>
                <div class='title' onclick="show('p<?php echo $el['id']; ?>')" ><?php echo $el['title']; ?></div>
            </div>
            <div class='subtitle'><?php echo $el['subtitle']; ?></div>
            <div class='description' id='p<?php echo $el['id']; ?>'><?php echo $el['description']; ?></div>

        </div>
        <?php }?>
        </div>
    </div>

    <div style="padding: 20px;">
        <center><img src='footer.webp' width='300' height='300'/></center>
    </div>
</body>
</html>