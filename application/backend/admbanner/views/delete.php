<?php echo form_open(uri_string());?>
<br/>
<table cellpadding="3" cellspacing="3" align="center" width="522">
    <tr>
        <td align="right" class="title_form"><?=$form_title_del?></td>
    </tr>
</table>
<table cellpadding="3" cellspacing="3" align="center" class="tb" width="522">
    <tr>
        <td colspan="2" class="delete_title" align="center"><?=$form_message_del?> <b><img src="<?php echo $title;?>" width="150"></b> ?</td>
    </tr>
    <tr align="center">
        <td>
            <?php echo form_submit('submit', 'Да');?>
        </td>
        <td>
            <?php echo form_button($but_back);?>
        </td>
    </tr>
</table>
<?php echo form_close();?>