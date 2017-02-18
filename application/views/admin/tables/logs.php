<table class="table table-stripe colls fixed" id="content">
    <tr>
        <th width="25%">Время</th>
        <th width="25%">Логин</th>
        <th width="25%">IP</th>
        <th width="25%">Результат</th>
    </tr>
</table>
<table class="table table-stripe colls">
    <?php
    //	print_r($arr);
    foreach($arr as $item) {

        ?>

        <tr>
            <td width="25%"><?php echo $item->_datetime; ?></td>
            <td width="25%"><?php echo $item->_login; ?></td>
            <td width="25%"><?php echo $item->_ip; ?></td>
            <td width="25%"><?php
                if ($item->_result=='1') { echo "Успешный вход"; }
                if ($item->_result=='2') echo "Неправильный пароль";
                ?></td>
        </tr>
        <?php
    }
    ?>
</table>