<div class="form_new">
<form id="formnew">
    <div class="form-text">
        <h3>Отправить сообщение клиенту</h3>
        <div class="input-text">

            <span>Заголовок: </span>
            <p><input class="login" type="text" placeholder="Введите заголовок новости" name="title"/></p>
        </div>
        <div class="input-text">
            <span>Текст: </span>
            <p><textarea name="text" rows="10"/></p>
        </div>
        <button id="btn-login" type="submit" class="btn btn-success formlogin">Добавить новость</button>
</form>
 </div>
<script>
    $(document).on('click', '.btn-success', function () {
        var dataSend = $('#formnew').serialize();
        //alert(dataSend);

        $.ajax({
            type: 'POST',
            url: '/test_web/admin/add_new',
            data: dataSend,
            dataType: "html",
            success: function (data) {
          //     alert(data)
            },
            error: function (data) {
            //    alert(data);
            }
        });
    });

</script>