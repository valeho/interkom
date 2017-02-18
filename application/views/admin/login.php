<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="/ci/bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="/ci/bootstrap/css/bootstrap-theme.min.css">        

        <script type="text/javascript" src="/ci/js/jquery-1.11.3.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="/ci/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="<?php echo dir;?>/css/style_admin.css" />
        <title>Панель управления - Авторизация</title>
    </head>
    <body>




           <div class="wrapper_form_auth">

                <div class="form_auth">

                    <form id="loginform" action="#">
                    <h1>Добро пожаловать</h1>
                        <div id="ajax_result2"></div>
                    <div class="form-text">
                        <div class="input-text">


                            <p><input class="login" type="text" placeholder="Введите ваш логин" name="username" id="login"/></p>
                        </div>
                        <div class="input-text"><p><input class="login" type="password" placeholder="Введите пароль" id="password" name="password"/></p>
                        </div>
                    </div>
                    </form>
                    <button id="btn-login" type="submit" class="btn btn-success formlogin">Вход в личный кабинет</button>

                </div>
           </div>


<script>
	$(document).on('click', '.btn-success', function () {
       var dataSend = $('#loginform').serialize();

		$.ajax({
            type: 'POST',
            url: '/test_web/admin/login',
            data: dataSend,
            success: function (data) {

                var newdata = JSON.parse(data, function (k,v) {
                    return v;
                });

                if(newdata.status == 1) {
                    $('#ajax_result2').html('<div class="alert alert-danger">Неверный логин и пароль</div>');
                
                } else {
                    location.reload(true);
                }
              
            },
            error: function () {
			    alert("ERROR");
            }
        });
	});
	
	</script>
    </body>
</html>