<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>

        <link rel="stylesheet" href="/ci/bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="/ci/bootstrap/css/bootstrap-theme.min.css">

        <script src="/ci/js/jquery-1.11.3.min.js"></script>

        <link rel="stylesheet" type="text/css" href="/ci/www/css/resources/css/ext-all.css" />
        <link rel="stylesheet" type="text/css" href="/ci/www/js/ux/css/LiveSearchGridPanel.css" />
        <link rel="stylesheet" type="text/css" href="/ci/www/js/ux/statusbar/css/statusbar.css" />
        <link rel="stylesheet" type="text/css" href="/ci/www/css/shared/example.css" />

        <!-- GC -->

        <script type="text/javascript" src="/ci/www/js/ext-all.js"></script>

        <!-- page specific -->
        <style type="text/css">
            /* style rows on mouseover */
            .x-grid-row-over .x-grid-cell-inner {
                font-weight: bold;
            }
        </style>
        <script type="text/javascript" src="/ci/www/js/live-search-grid.js"></script>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    if (is_null($loginData))
                    {
                        ?>
                        <a href="#" data-toggle="modal" data-target="#autorizModal">Авторизация</a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="#" onclick="logout();
                                    return false;">Выход</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <hr>
            <div>
                <div id="grid-ex"></div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="autorizModal" tabindex="-1" role="dialog" aria-labelledby="autorizModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Авторизация</h4>
                    </div>
                    <div class="modal-body">
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
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button id="btnSend" type="button" onclick="send_form();" class="btn btn-default" data-loading-text="Loading...">Вход</button>
                    </div>
                </div>
            </div>
        </div>        
        <script>
            function send_form()
            {
                var $btn = $('#btnSend').button('Проверка...');

                var dataSend = $('#formLogin').serialize();
                $.ajax({
                    type: 'POST',
                    url: '/ci/welcome/login',
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
                    error: function ()
                    {
                        $('#ajax_result').html('<div class="alert alert-danger">Ошибка выполнения запроса!</div>');
                        $btn.button('reset')
                    }
                });
            }

            function logout() {
                $.ajax({
                    type: 'POST',
                    url: '/ci/welcome/logout',
                    success: function (data) {
                        location.reload(true);
                    },
                    error: function ()
                    {
                        $('#ajax_result').html('<div class="alert alert-danger">Ошибка выполнения запроса!</div>');
                    }
                });
            }
        </script>

        <script src="/ci/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
