<style>

.post{

}

.title{
    cursor: pointer;

}

.title:hover{
    background-color: gray;
}

.subtitle{

}

.description{
    display: none;
}

.col100{
    width: 100%;
}

.edit-button{
    
}

textarea{
    width: 100%;
    height: 200px;
    background-color: transparent;
    margin: 20px;
}

.title-area{
    height: 100px;
}

.subtitle-area{
    height: 75px;
}

.description-area{
    height: 150px;
}

</style>

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

<form action='./panel' method='get'>
<?php
$arrTags = selcetTable("tags");
foreach($arrTags as $tag){
?>
    <label>
    <input type='checkbox' name='tg[]' value='<?php echo $tag['name'];?>'>
    <?php echo $tag['name']; ?>
    </label>
<?php }?>
    <input type='submit' name='' value='show'>
</form>

<?php foreach($arr as $el){ ?>
<div class='post' id='post<?php $el['id'];?>'>
    <span style='visibility:hidden'><?php echo $el['id']; ?></span>

    <div class='col100'>
        <div class='title' onclick="show('p<?php echo $el['id']; ?>')" ><?php echo $el['title']; ?></div>
    </div>

    <div class='subtitle'><?php echo $el['subtitle']; ?></div>
    <div id='p<?php echo $el["id"]; ?>' class='description'>
        <form action='e-rec' method='get'>
            <?php 

            $tagsChecked = getPostTags($el["id"]);

            foreach ($arrTags as $tag) {
                $flag= 0;
                foreach($tagsChecked as $checkedTag){
                    if($tag['name'] == $checkedTag['name']){ ?>
                        <label>
                            <input type="checkbox" name="tags[]" value="<?php echo $tag['name']; ?>" checked/> 
                            <?php echo $tag['name']; ?>
                        </label>
                    <?php
                        $flag=1;
                        break;
                    }
                }

                if($flag == 1){
                    $flag = 0;
                    continue;
                }else{ ?>
                    <label>
                        <input type="checkbox" name="tags[]" value="<?php echo $tag['name']; ?>" /> 
                        <?php echo $tag['name']; ?>
                    </label>
                <?php
                }
                ?>
            <?php } ?>
            <input type='hidden' name='nr' value="<?php echo $el["id"]; ?>"/>
            <br></br>
            Title:
            <textarea class='title-area' name='t' id='t<?php echo $el["id"]; ?>'><?php echo $el['title']; ?></textarea>
            Subtitle:
            <textarea class='subtitle-area' name='st' id='st<?php echo $el["id"]; ?>'><?php echo $el['subtitle']; ?></textarea>
            Description:
            <textarea class='description-area' name='d' id='d<?php echo $el["id"]; ?>'><?php echo $el['description']; ?></textarea>
            <input type='submit' value='edit'/>
        </form>
    </div>
</div>
<?php }?>