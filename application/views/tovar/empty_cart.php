<?php $this->load->view('template/head'); ?>
<div class="wrapper">
    <?php $this->load->view('template/top_2'); ?>
    <style>

        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 6px;
        }

    </style>
    <div class="bread">
        <span class="arr_b">Главная</span>
        <span class="arr_b1">Корзина</span>
        <div class="clr"></div>
    </div>
    <div class="content-main" style="width: 100%;">
        <div class="main-block" style="width: 100%;">
            <div class="text-block-main" style="margin-top: 10px;">                
                <div>

                    <div style="padding: 10px;">
                        <div class="alert alert-info">Ваша корзина пуста. Перейдите в каталог для её заполнения.</div>
                        <div id="ajax_result"></div>
                        <a class="btn btn-sm btn-primary" href="http://opt.interkom.kz/opt/tovar"> Назад</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <div id="ajax_result"></div>
    
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
</script>
<script src="/ci/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
