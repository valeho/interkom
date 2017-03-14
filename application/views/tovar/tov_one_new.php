<div class="row">
   <div style="padding-left:20px; padding-bottom:30px; height:20px; vertical-align: middle"><a href="#" class="btn_news" data-target="#News"><span class="cursor"><img style="padding-right:10px" src="/opt/img/arrow.png" /></span>
           Вернуться к списку новостей</a>
       <button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close"><span
               aria-hidden="true">&times;</span></button>
   </div>
    <hr style="width: 700px;"/>
</div>
<div class="row" style="padding-bottom:10px; margin-top:-15px;">
    <span class="news_header"><?php echo $arr['title']; ?></span>
</div>

<div class="news_title row">


    <?php //echo $item['date']; ?>
    <div class="news_image">
        <img src="/a2dsrc/media/images/ico_no-photo.svg" width="112px" height="100px" style="border-radius:3px; border: solid 1px #ccc "/>
    </div>
    <div class="content_news col-sm-9">

        <p><?php echo $arr['news']; ?></p>

    </div>

</div>
<div class="row" style="margin-top:10px; ">
    <div class="news_left"><p>Список добавленных товаров</p></div>
</div>
    <div id="NewsMenu">
        <div id="formAddToCart">
        <table class="colls table table-striped colls_news" style="margin-top:0px;">
            <tr class="col_insert_new">
                <th width="80" class="text-center">Фото</th>
                <th width="65">Код</th>
                <th width="160">Артикул</th>
                <th>Наименование</th>
                <th width="55" class="text-center">Цена</th>
                <th width="105" class="text-center"><span style="color:#fff; font-weight:bold;">Добавить в корзину</span>
                </th>
            </tr>
        <?php
        foreach ($arr['tovar'] as $item) {

       /* if($item['incart']==1) $sty = "style='background-color:yellow;'";
        if($item['inwork']==1) $sty2 = "style='background-color:yellow;'";*/
        ?>

        <tr class="col_insert" <?php
      /* echo @$sty;
        echo @$sty2;*/
        ?>>
            <?php $sty=''; $sty2=''; ?>
            <td width="80" class="text-center"><?php if ($item['pic'] == 1) {
                ?><a href="#" class="imageshow" image="<?php echo $item['id']; ?>" data-toggle="modal" data-target="#showimage3"><img src="/ci/img/dummy-articol.png"></a>
            </td>                                            <?php } else echo "</td>";?>
            <td width="65" class="text-center"><?php echo trim($item['code']); ?></td>
            <td width="140" class="text-center"><?php echo mb_substr($item['article'], 0, 15, 'UTF8'); ?></td>
            <td width="auto" style=""><?php echo mb_substr($item['title'], 0, 150, 'UTF8'); ?></td>
            <td width="55" class="text-center"><?php echo $item['price']; ?></td>
            <td width="105" class="text-center" style="text-align:center"><?php echo $item['defData']; ?></td>
        </tr>
        <?php


}
?>
            </table>
    </div>


</div>
