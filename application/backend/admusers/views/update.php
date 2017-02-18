<?php echo form_open_multipart(uri_string());?>

<? if(form_error('title')) {?>
<div class="box_error">
    <div class="error_form"><?php echo form_error('title'); ?></div>
    <div class="error_form"><?php echo form_error('place'); ?></div>
</div>
<? } ?>

<table cellpadding="3" cellspacing="3" align="center" width="522">
    <tr>
        <td align="left" class="title_form"><?=$form_title_edit?></td>
    </tr>
</table>

<table cellpadding="3" cellspacing="3" class="tb" align="center">
    <tr>
        <td class="name" width="100"><?=$title_field?></td>
        <td align="left">
            <?php echo form_input($title);?>
        </td>
    </tr>
    <tr>
        <td class="name" width="100"><?=$place_field?></td>
        <td align="left">
            <?php echo form_input($place);?>
        </td>
    </tr>
</table>
<br/>
<table cellpadding="3" cellspacing="3" align="center" width="522">
    <tr>
        <td colspan="2" align="right">
            <?=form_submit('sub_but','Сохранить')?>
            <?=form_button($but_back)?>
        </td>
    </tr>
</table>

<? echo form_close(); ?>