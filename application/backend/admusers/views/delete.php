<?php echo form_open(uri_string());?>
<?php $js = 'onClick="javascript:history.back(-1);" class="but_back"';?>
<br/>
<table cellpadding="3" cellspacing="3" align="center" width="522">
    <tr>
        <td align="right" class="title_form"><?=$form_title_del?></td>
    </tr>
</table>
<table cellpadding="3" cellspacing="3" align="center" class="tb" width="522">
    <tr>
        <td colspan="2" class="delete_title" align="center"><?=$form_message_del?> <b><?php echo $title->username;?></b> ?</td>
    </tr>
    <tr align="center">
        <td>
            <?php echo form_submit('submit', 'Да');?>
        </td>
        <td>
            <?php echo form_button('cancel', 'Отмена', $js);?>
        </td>
    </tr>
</table>
<?php echo form_close();?>