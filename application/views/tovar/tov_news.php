<?php
if (!empty($arr)) {
    ?>
    <div id="NewsTable_wrapper">
        <div class="row">
        <div style='font-family: "GothamProMedium"; font-size:29px; padding-left:14px; margin-bottom: 10px;'>Новости<button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close" style="position:relative; top:-5px;"><span aria-hidden="true">×</span></button></div>

        </div>
        <div id="news_table">
            <table>
                
            </table>
        </div>
    <div id="NewsMenu">
    <?php
    foreach ($arr as $item) {
        ?>
            <div class="news_title row">
                <?php //echo $item['date']; ?>
                <div class="news_image">
                    <img src="/a2dsrc/media/images/ico_no-photo.svg" width="112px" height="100px" style="border-radius:3px; border: solid 1px #ccc "/>
                </div>
                <div class="content_news col-sm-9">
                    <div class="content_header"><?php echo $item['title']; ?></div>
                    <p><?php echo $item['news']; ?></p>
                    <div style="margin-bottom:20px; top:10px; posi">
                <a href="#" guid="<?php echo $item['guid'];?>" class="button">
                    Читать полностью</a>
                    </div>
                </div>

            </div>
        <div class="row">
            <hr style="width: 700px;"/>
        </div>
        <?php
    }

}
?>
        <div class="button_wrapper">
            <a class="btn_news_all" style="width:200px; text-align:center; border-radius: 3px;">Показать все новости</a>
        </div>
    </div>


    </div>

