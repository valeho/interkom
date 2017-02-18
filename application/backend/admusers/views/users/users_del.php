<br /><br /><br />
<?php $js = 'onClick="javascript:history.back(-1);"';?>
<?php echo form_open(uri_string());?>
<table cellpadding="3" cellspacing="3" class="tb1" align="center">
    <tr>
        <td colspan="2">Вы действительно хотите удалить пользователя: <b><?php echo $user->first_name .'&nbsp;'. $user->last_name;?></b> ?
            <?php echo form_hidden('id', $user->id);?>
            <?php echo form_hidden($csrf); ?>
        </td>
    </tr>
    <tr align="center">
        <td>
            <?php echo form_submit('submit', 'Да');?>
        </td>
        <td>
            <?php echo form_button('cancel', 'Нет', $js);?>
        </td>
    </tr>
</table>
<?php echo form_close();?>