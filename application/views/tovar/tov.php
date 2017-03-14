
<?php
if (!empty($arr))
{
    foreach ($arr as $item)
    {
        if($item['incart']==1) $sty = "style='background-color:yellow;'";
        if($item['inwork']==1) $sty2 = "style='background-color:yellow;'";
        ?>

        <tr class="col_insert" <?php
        echo @$sty;
        echo @$sty2;
        ?>>
            <?php $sty=''; $sty2=''; ?>
            <td width="80" class="text-center"><?php if ($item['pic'] == 1) {
                ?><a href="#" class="imageshow" image="<?php echo $item['id']; ?>" data-toggle="modal" data-target="#showimage3"><img src="/ci/img/dummy-articol.png"></a>

            </td>                                            <?php } else echo "</td>";?>
            <td width="65" class="text-center"><?php echo trim($item['code']); ?></td>
            <td width="140" class="text-center"><?php echo mb_substr($item['article'], 0, 15, 'UTF8'); ?></td>
            <td width="auto" style="padding-left:25px;"><?php echo mb_substr($item['title'], 0, 150, 'UTF8'); ?></td>

            <td width="100" class="text-center"><?php echo $item['mkei']; ?></td>
            <td width="80" class="text-center"><?php


                echo $item['norm'];  ?></td>
            <td width="42" class="text-center"><?php
                $pic = "plus.png";
                if ($item['is'] == '~') { $pic = "car.png"; }
                if ($item['is'] == '-') { $pic = "-.png"; }
                echo "<img src=\"/a2dsrc/media/images/".$pic."\">"; ?></td>

            <td width="55" class="text-center"><?php echo $item['price']; ?></td>
            <td width="105" class="text-center"><?php echo $item['defData']; ?></td>
        </tr>
        <?php
    }


}
?>