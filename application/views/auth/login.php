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

        <title>Панель управления - Авторизация</title>
    </head>
    <body>
		<div id="#ajax_result"></div>
        <div class="container">    
            <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Авторизация</div>
                    </div>     

                    <?php if (!empty($message)): ?>
                        <div class="alert alert-danger"><?php echo $message; ?></div>
                    <?php endif; ?>

                    <div style="padding-top:30px" class="panel-body" >
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        <form id="loginform" class="form-horizontal" role="form" method="post" action="">
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="логин">                                        
                            </div>
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="login-password" type="password" class="form-control" name="password" placeholder="пароль">
                            </div>
                            <div class="input-group">
                                <div class="checkbox">
                                    <label>
                                        <input id="login-remember" type="checkbox" name="remember" value="1"> Запомнить меня
                                    </label>
                                </div>
                            </div>
                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->
                                <div class="col-sm-12 controls">
                                    <button id="btn-login" type="submit" class="btn btn-success">Вход</button>
                                </div>
                            </div>                            
                        </form>   
                    </div>                     
                </div>  
            </div>
        </div>

<script>
	$(document).on('submit', '#loginform', function () {
       var dataSend = $('#loginform').serialize();
		alert(dataSend);
		
		$.ajax({
            type: 'POST',
            url: '/test_web/admin/login',
            data: dataSend,
            dataType: "json",
            success: function (data) {

                if (data.status == 1) {
                    $('#ajax_result').html('<div class="alert alert-success">' + data.message + '</div>');
                    location.reload(true);
                } else {
                    $('#ajax_result').html('<div class="alert alert-danger">' + data.message + '</div>');
                }
                $btn.button('reset')
            },
            error: function () {

                $('#ajax_result').html('<div class="alert alert-danger">Ошибка выполнения запроса!</div>');
                $btn.button('reset')
            }
        });
	});
	
	</script>
    </body>
</html>