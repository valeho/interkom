<html>
    <head>
        <title>Авторизация</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="/ci/bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="/ci/bootstrap/css/bootstrap-theme.min.css">

        <script src="/ci/js/jquery-1.11.3.min.js"></script>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div id="ajax_result"></div>
                    <form id="formLogin">
                        <div class="form-group">
                            <label for="inputLogin">Логин</label>
                            <input type="text" class="form-control" id="inputLogin" name="login" placeholder="Логин">
                        </div>
                        <div class="form-group">
                            <label for="inputPass">Пароль</label>
                            <input type="password" class="form-control" id="inputPass" name="passwd" placeholder="Пароль">
                        </div>
                        <button id="btnSend" type="button" onclick="send_form();" class="btn btn-default" data-loading-text="Loading...">Авторизоваться</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function send_form()
            {
                var $btn = $('#btnSend').button('Проверка...');

                var dataSend = $('#formLogin').serialize();
				console.log(dataSend);
                $.ajax({
                    type: 'POST',
                    url: 'http://newtest.interkom.kz/opt/tovar/login',
                    data: dataSend,
                    //dataType: "json",
                    success: function (data) {
					console.log(data);
                        $('#ajax_result').html('<div class="alert alert-danger">Ошибка выполнения запроса!</div>');

                        $btn.button('reset')
                    }
                });
            }
        </script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="/ci/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
