<?php
if (!empty($arr)) {
    ?>
    <div id="NewsTable_wrapper">
        <div id="news_table">
            <table>
                
            </table>
        </div>
    <div id="NewsMenu">
    <?php
    foreach ($arr as $item) {
        ?>
            <p class="news_title">

                <a href="#" onclick="ShowNew('<?php echo $item['guid']; ?>')"><?php echo $item['date']; ?><br />
                    <?php echo $item['title']; ?></a>
            </p>

        <?php
    }

}
?>
    </div>


    </div>

