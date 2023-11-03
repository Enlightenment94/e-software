<style>
.nr-tag{
    float:left;
    width: 25px;
}

.tag{
    float:left;
    width: 100px;
}

.del-tag-button{
    width: 50px;
    float: left;
}

.del-tag-button{
    float: left;
}
</style>

<?php

$arr = selcetTable("tags");

foreach($arr as $el){
?>
<div id='tagsMgr'>
    <div>
        <div class='nr-tag'><?php echo $el['id'];?></div>
        <div class='tag'><?php echo $el['name'];?></div>
        <div class='del-tag-button'>
            <form action='d-tag'>
                <input name='tg-nr' type='hidden' value="<?php echo $el['id'];?>"/>
                <button>del</button>
            </form>
        </div>
    </div>

    <div class='edit-tag-button'>
        <form action='e-tag'>
            <input name='tg' type='text' value="<?php echo $el['name'];?>"/>
            <input name='tg-nr' type='hidden' value="<?php echo $el['id'];?>"/>
            <button>edit</button>
        </form>
    </div>

<?php };?>

    <p>New tag: </p>
    <form action='db-tag' method='get'>
        <input name='tg' value='example'/>
        <input type='submit' value='send'/>
    </form>

</div>