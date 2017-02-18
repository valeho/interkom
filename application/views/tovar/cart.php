<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <link href="/test_web/css/style_new.css" media="all" rel="stylesheet" type="text/css">
        <link href="/test_web/css/n.css" media="all" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/ci/bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="/ci/bootstrap/css/bootstrap-theme.min.css">

        <script src="/ci/js/jquery-1.11.3.min.js"></script>

        <link rel="stylesheet" type="text/css" href="/opt/js/tbdata/media/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="/ci/js/tbdata/examples/resources/syntax/shCore.css">
        <link rel="stylesheet" type="text/css" href="/ci/js/tbdata/examples/resources/demo.css">

        <script type="text/javascript" language="javascript" src="/ci/js/tbdata/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="/ci/js/tbdata/examples/resources/syntax/shCore.js"></script>
        <script type="text/javascript" language="javascript" class="init">

            $(document).ready(function () {
                var newHeight = $(window).height() - 220;
                var tb = $('#example').DataTable({
                    "language": {
                        "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Russian.json"
                    },
                    scrollY: newHeight,
                    scrollCollapse: true,
                    "lengthChange": false,
                    "lengthMenu": false,
                    "pageLength": 'All',
                    "processing": true,
                    "serverSide": true,
                    "bFilter": false,
                    "autoWidth": true,
                    "paging": false,
                    "order": [],
                    "info": false,
                    "ajax": {
                        "url": "/opt/tovar/ajax_search_cart",
                    },
                    "columns": [
                        {"data": "code"},
                        {"data": "article"},
                        {"data": "title"},
                        {"data": "mkei", className: "text-center"},
                        {"data": "norm", className: "text-center"},
                        {"data": "count", className: "text-center count"},
                        {"data": "amount", className: "text-center"},
                        {"data": "defData"}
                    ],
                });
            });
        </script>
        <link href="<?php echo dir; ?>/css/style_new.css" media="all" rel="stylesheet" type="text/css">
        <style>
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
                padding: 1px;
            }
            #menu_vv{
                position: fixed;
                z-index: 1000;
                height: 51px;
                width: 100%;
                top: 0px;
            }
            .colls{
                margin-top: 111px;
            }
        </style>

    </head>
    <body>
        <div class="wrapper">
            <?php $this->load->view('template/top_2'); ?>

            <div class="bread">
                <a href="<?php echo dir; ?>/tovar"><span class="arr_b">Главная</span></a>
                <span class="arr_b1">Корзина</span>
                <div class="clr"></div>
            </div>
            <div class="content-main" style="width: 100%; position:fixed">
                <div class="main-block" style="min-height: 650px;width: 100%;">
                    <div class="text-block-main" style="margin-top: 10px;border:none;">
                        <div style="padding: 10px;">
                            <div id="ajax_result"></div>
                            <?php // echo dir.'/tovar/showSumm/'.$loginData['binaryData']; ?>
                            <table id="example" class="table display compact" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="65">Код</th>
                                        <th width="158">Артикул</th>
                                        <th>Наименование</th>                                    
                                        <th width="100" class="text-center">Ед. изм.</th>
                                        <th width="80" class="text-center">Норм. уп.</th>
                                        <th width="65" class="text-center">Кол-во</th>
                                        <th width="65" class="text-center">Цена</th>
                                        <th width="25"></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="8">Итого: <span id="summa"><?php echo $sum; ?></span></td>
                                    </tr>
                                </tfoot>
                            </table>

                            <p></p>
                            <a class="btn btn-sm btn-primary" href="http://opt.interkom.kz/opt/tovar"> Назад</a>
                            <?php
                            if (!empty($content))
                            {
                                ?>

                                <button class="btn btn-sm btn-primary" onclick="confrimCart();"><i class="glyphicon glyphicon-ok"></i> Подтвердить заказ</button>
                                <button class="btn btn-sm btn-danger" onclick="delItemAll()"><i class="glyphicon glyphicon-remove"></i> Очистить корзину</button>

                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
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
        
            <!-- Yandex.Metrika counter -->
            <script type="text/javascript">
                (function (d, w, c) {
                    (w[c] = w[c] || []).push(function() {
                        try {
                            w.yaCounter38205820 = new Ya.Metrika({
                                id:38205820,
                                clickmap:true,
                                trackLinks:true,
                                accurateTrackBounce:true,
                                webvisor:true,
                                ut:"noindex"
                            });
                        } catch(e) { }
                    });

                    var n = d.getElementsByTagName("script")[0],
                        s = d.createElement("script"),
                        f = function () { n.parentNode.insertBefore(s, n); };
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = "https://mc.yandex.ru/metrika/watch.js";

                    if (w.opera == "[object Opera]") {
                        d.addEventListener("DOMContentLoaded", f, false);
                    } else { f(); }
                })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/38205820?ut=noindex" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <script>
        <!-- /Yandex.Metrika counter -->
            function send_form()
            {
                var $btn = $('#btnSend').button('Проверка...');

                var dataSend = $('#formLogin').serialize();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo dir; ?>/tovar/login',
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

            function updCart(input) {
                var colvo = $(input).val();
                var tovar_id = $(input).data('tovar-id');
                var amount = $(input).data('amount');
                if (colvo == '') {
                    alert('Поле Кол-во не может быть пустым!');
                    return;
                }
                $.ajax({
                    type: 'POST',
                    url: '/test_web/tovar/updCart',
                    data: {colvo: colvo, tovar_id: tovar_id, amount: amount},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 1) {
                            console.log(colvo, amount);
                            $('#price' + tovar_id).html(colvo * amount);
                            $('#summa').html(data.summa);
                        } else {
                            $('#ajax_result').html('<div class="alert alert-danger">' + data.message + '</div>');
                        }
                    },
                    error: function ()
                    {
                        $('#ajax_result').html('<div class="alert alert-danger">Ошибка выполнения запроса!</div>');
                    }
                });
                CheckBalance();
            }

            function delItem(item) {
                var tovar_id = $(item).data('tovar-id');
                $.ajax({
                    type: 'POST',
                    url: '<?php echo dir; ?>/tovar/delCart',
                    data: {tovar_id: tovar_id},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 1) {
                            location.reload(true);
                        } else {
                            $('#ajax_result').html('<div class="alert alert-danger">' + data.message + '</div>');
                        }
                    },
                    error: function ()
                    {

                        location.reload(true);
                    }


                });
                CheckBalance();
            }
            setInterval(CheckBalance(), 100);
            function delItemAll() {
                $.ajax({
                    type: 'POST',
                    url: '/test_web/tovar/delAllCart',
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 1) {
                            location.reload(true);
                        } else {
                            $('#ajax_result').html('<div class="alert alert-danger">' + data.message + '</div>');
                        }
                    },
                    error: function ()
                    {

                        location.reload(true);
                    }


                });
                CheckBalance();

            }

            function CheckBalance() {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo dir; ?>/tovar/echoshowSumm/<?php echo $loginData['binaryData']; ?>',
                    success: function (data) {
                        $('#summcart').html(data);
                    }
                })
            }


            function confrimCart() {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo dir; ?>/tovar/confirmCart',
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 1) {
                            location.reload(true);
                        } else {
                            //$('#ajax_result').html('<div class="alert alert-danger">' + data.message + '</div>');
                            location.reload(true);
                        }
                    },
                    error: function ()
                    {
                       /// $('#ajax_result').html('<div class="alert alert-danger">Ошибка выполнения запроса!</div>');
                    }

                });
                location.reload(true);
            }
        </script>
        <script src="/opt/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
