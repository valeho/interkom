<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Пользователи</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <h4><?= $form_title_add ?></h4>
                <?php
                if (!empty($message))
                {
                    ?>
                    <div class="alert alert-danger"><?php echo $message; ?></div>
                    <?php
                }
                ?>
                <?php $js = 'onClick="javascript:history.back(-1);" class="btn btn-primary"'; ?>
<?php echo form_open("admusers/add_data"); ?>
                <table class="table table-bordered" align="center">
                    <tr>
                        <td>Имя</td>
                        <td><?php echo form_input($first_name); ?></td>
                    </tr>
                    <tr>
                        <td>Фамилия</td>
                        <td><?php echo form_input($last_name); ?></td>
                    </tr>
                    <tr>
                        <td>Организация</td>
                        <td><?php echo form_input($company); ?></td>
                    </tr>
                    <tr>
                        <td>Логин</td>
                        <td><?php echo form_input($username); ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo form_input($email); ?></td>
                    </tr>
                    <tr>
                        <td>Пароль</td>
                        <td><?php echo form_input($password); ?></td>
                    </tr>
                    <tr>
                        <td>Подтврждение пароля</td>
                        <td><?php echo form_input($password_confirm); ?></td>
                    </tr>
                    <tr>
                        <td>Тип пользователя</td>
                        <td><?php echo form_dropdown('type_user', $type_user, '', 'class="form-control input-sm"'); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?php echo form_submit('submit', 'Сохранить', 'class="btn btn-primary"');
echo form_button('cancel', 'Отмена', $js);
?></td>
                    </tr>
                </table>
<?php echo form_close(); ?>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</div>