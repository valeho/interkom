<table class="table table-stripe colls fixed" id="content">
    <tr>
        <th width="40%">Логин</th>
        <th width="40%">Пароль</th>
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
            <td width="40%"><?php echo $item->login; ?></td>
            <td width="40%"><?php echo $item->password; ?></td>
            <td><a href="<?php echo dir; ?>/admin/get_edit_admin/<?php echo $item->id; ?>">Редактировать</a>
                <a href="<?php echo dir; ?>/admin/del_admin/<?php echo $item->id; ?>">Удалить</a>
            </td>
        </tr>
        <?php
    }
    }
    ?>   </table>