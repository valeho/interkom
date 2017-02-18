<?php //print_r($data); ?>
<div class="form_new">
    <form id="formnew">
        <div class="form-text">
            <div class="input-text">

                <span>Логин: </span>
                <p><input class="login" type="text" placeholder="Введите логин" name="login" value="<?php echo @$login; ?>"/></p>
            </div>
            <div class="input-text">
                <span>Пароль: </span>
                <p><input class="login" type="text" placeholder="Введите пароль" name="password" value="<?php echo @$password; ?>"/></p>
            </div>
                <?php
                if(@$edit=='1') {
                    ?><input type="hidden" name="edit" value="1" />
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <?php
                }?>

            <button id="btn-login" type="submit" class="btn btn-success formlogin">Добавить администратора</button>
    </form>
</div>
<script>
    $(document).on('click', '.btn-success', function () {
        var dataSend = $('#formnew').serialize();
        //alert(dataSend);

        $.ajax({
            type: 'POST',
            url: '/test_web/admin/add_admin',
            data: dataSend,
            dataType: "html",
            success: function (data) {
           //     alert(data);
            },
            error:function(xhr, status, error) {

                alert("ERROR");
            }
        });
    });

</script>