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
           // alert(newHeight);
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
                    "url": "<?php echo dir; ?>/tovar/ajax_search_magazine/<?php echo $guid;?>",
                    "data": {
                        "newurl": "",
                    }
                },
                "columns": [
                    {"data": "npp"},
                    {"data": "code"},
                    {"data": "art"},
                    {"data": "descr"},
                    {"data": "ed"},


                    {"data": "count"},
                    {"data": "exec"},
                    {"data": "price"},
                    {"data": "amount"},
                    {"data": "amount_exec"}

                ],
            });
        });
    </script>
    <link href="/test_web/css/style_new.css" media="all" rel="stylesheet" type="text/css">
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
<style>

    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 6px;
    }

</style>
<div class="bread">
    <a href="<?php echo dir; ?>/tovar"><span class="arr_b">Главная</span></a>
    <span class="arr_b1">Заявка</span>
    <div class="clr"></div>
</div>
<div class="content-main" style="width: 100%; position:fixed; ">
    <div class="main-block" style="min-height: 650px;width: 100%;">
        <div class="text-block-main" style="margin-top: 10px;border:none;">
            <div style="padding: 10px;">
                <div id="ajax_result"></div>

                <table id="example" class="table display compact" cellspacing="0">
                    <thead>

                            <tr>
                                <th width="20">№</th>
                                <th width="40">Код</th>
                                <th width="150">Артикул</th>
                                <th>Товар</th>
                                <th width="40" >ЕИ</th>
                                <th  width="40">Заявка</th>
                                <th width="40" >Резерв</th>
                                <th  width="40">Цена</th>
                                <th  width="40">Сумма</th>
                                <th width="40">СуммаРез</th>
                            </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <td colspan="10" class="text_right">Сумма заявки: <span id="summa"><?php echo $summ; ?></span></td>
                    </tr>
                    <tr>
                        <td colspan="10" class="text_right">Сумма резерва: <span id="summa_res"><?php echo $summ_exec; ?></span></td>
                    </tr>
                    </tfoot>

                    </table>

                        <a class="btn btn-sm btn-primary" href="http://opt.interkom.kz/opt/magazine"> Назад</a>
                    </div>
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
<!-- /Yandex.Metrika counter -->
<script>

    function send_form()
    {
        var $btn = $('#btnSend').button('Проверка...');

        var dataSend = $('#formLogin').serialize();
        $.ajax({
            type: 'POST',
            url: '/opt/tovar/login',
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
</script>
<script src="/ci/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
