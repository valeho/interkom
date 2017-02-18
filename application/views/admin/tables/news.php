<table class="table table-stripe colls fixed" id="content">
    <tr>
        <th width="40%">Заголовок</th>
        <th width="40%">Время</th>
        <th></th>
    </tr>
</table>

<?php
// print_r($arr);
if(!empty($arr)) {
?>
<table class="table table-stripe colls"><?php
    foreach ($arr as $item) {

        ?>

        <tr>
            <td width="40%"><?php echo $item->title; ?></td>
            <td width="40%"><a href="<?php echo dir."/admin/get_show_new/".$item->id; ?>"><?php echo $item->time; ?></a></td>
            <td>&nbsp;</td>
        </tr>
        <?php
    }
    }
    ?>   </table>