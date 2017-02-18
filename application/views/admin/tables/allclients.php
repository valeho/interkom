<table class="table table-stripe colls fixed" id="content">
    <tr>
        <th width="16%">Наименование</th>
        <th width="16%">Логин</th>
        <th width="16%">Пароль</th>
        <th width="16%">Корзина</th>
        <th width="16%">Баланс</th>
        <th width="16%">&nbsp;</th>
    </tr>
</table>
<table class="table table-stripe colls ">

<?php
    foreach($arr as $item) {

        ?>

        <tr>

            <td width="16%"><?php echo $item->_Desc; ?></td>
            <td width="16%"><?php echo $item->_login; ?></td>
            <td width="16%"><?php echo $item->_passwd; ?></td>
            <td width="16%"><?php echo $item->_cart; ?></td>
            <td width="16%"><?php echo $item->_balance; ?></td>
            <td width="16%"><a href="<?php echo dir; ?>/admin/get_cart/<?php echo $item->_UID; ?>"><img height="20px" src="/a2dsrc/media/images/basket_admin.png" /></a></td>
        </tr>
        <?php
    }
    ?>
</table>