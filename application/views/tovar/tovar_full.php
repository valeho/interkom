<?php $this->load->view('template/head'); ?>
<div class="wrapper">
    <?php $this->load->view('template/top_head'); ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div>
                        <form id="searchForm">
                            <table class="table" style="background-color:white;" id="menu_vv">
                                <thead style="background-color:white;">
                                    <tr style="background-color:white;">
                                        <td colspan="8">
                                            <?php
                                            if (is_null($loginData))
                                            {
                                                ?>
                                                <ol class="breadcrumb">
                                                    <li class="active">Главная</li>
                                                    <li><a href="#" data-toggle="modal" data-target="#autorizModal">Авторизация</a></li>
                                                </ol>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <ol class="breadcrumb">   
                                                    <li class="active">Главная</li>
                                                    <li><a href="http://opt.interkom.kz/ci/tovar/cart">Корзина</a></li>
                                                    <li><a href="http://opt.interkom.kz/ci/magazine/index">Журнал</a></li>
                                                    <li><a href="#" onclick="logout();
                                                            return false;">Выход</a></li>
                                                </ol>

                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr style="background-color:white;">
                                        <td colspan="8">
                                            <input type="radio" name="group" value="1" id="vaz" class="radio-inline" checked onclick="search();"> ВАЗ
                                            <input type="radio" name="group" value="3" id="larg" class="radio-inline" onclick="search();"> Ларгус-РЕНО 
                                            <input type="radio" name="group" value="4" id="hyn" class="radio-inline" onclick="search();"> Hyundai Kia
                                            <input type="radio" name="group" value="5" id="dae" class="radio-inline" onclick="search();"> DAEWOO
                                            /
                                            <input type="checkbox" name="is_new" value="1" id="is_new" class="radio-inline" onclick="search();"> Новинки
                                        </td>
                                    </tr>
                                    <tr style="background-color:white;">
                                        <td width="65"><input type="text" name="code" id="code" placeholder="Код" style="width:100%;" onkeyup="search();"></td>
                                        <td width="158"><input type="text" name="art" id="art" placeholder="Артикул" style="width:100%;" onkeyup="search();"></td>
                                                <td><table width="100%">
                                                        <tr>
                                                            <td><input type="text" name="title" id="title" placeholder="Наименование" style="width:100%;" onkeyup="search();"></td>
                                                            <td width="210">&nbsp;<input type="checkbox" name="accur" value="1" id="accur" class="checkbox-inline" onclick="search();"> поиск по ключевому слову</td>
                                                        </tr>
                                            </table>
                                            
                                            
                                        </td>
                                        <td width="80"></td>
                                        <td width="100"></td>
                                        <td width="80"></td>
                                        <td width="15"></td>
                                        <td width="65"></td>
                                        <td width="53">&nbsp;</td>
                                    </tr>     
                                    <tr>
                                        <th width="65">Код</th>
                                        <th width="158">Артикул</th>
                                        <th>Наименование</th>
                                        <th width="80" class="text-center">Фото</th>
                                        <th width="100" class="text-center">Ед. изм.</th>
                                        <th width="80" class="text-center">Норм. уп.</th>
                                        <th width="15" class="text-center">Ост.</th>
                                        <th width="65" class="text-center">Цена</th>
                                        <th width="53">&nbsp;</th>
                                    </tr>
                                </thead>
                            </table>
                            <table class="table colls">
                                <tr class="col_insert_new">
                                    <th width="65">Код</th>
                                    <th width="158">Артикул</th>
                                    <th>Наименование</th>    
                                    <th width="80" class="text-center">Фото</th>
                                    <th width="100" class="text-center">Ед. изм.</th>
                                    <th width="80" class="text-center">Норм. уп.</th>
                                    <th width="15" class="text-center">Ост.</th>
                                    <th width="65" class="text-center">Цена</th>
                                    <th width="25">&nbsp;</th>
                                </tr>
                                <?php
                                if (!empty($arr))
                                {
                                    foreach ($arr as $item)
                                    {
                                        $sty = ($item['incart']) ? "style='background-color:yellow;'" : "";
                                        ?>
                                        <tr class="col_insert" <?php echo $sty; ?>>
                                            <td><?php echo $item['code']; ?></td>
                                            <td><?php echo mb_substr($item['article'], 0, 15, 'UTF8'); ?></td>
                                            <td><?php echo mb_substr($item['title'], 0, 150, 'UTF8'); ?></td>
                                            <td width="80" class="text-center"><center><?php echo ($item['pic'] == 1)?'<img src="/ci/img/dummy-articol.png">':''; ?></center></td>
                                            <td width="100" class="text-center"><?php echo $item['mkei']; ?></td>
                                            <td width="80" class="text-center"><?php echo $item['norm']; ?></td>
                                            <td width="15" class="text-center"><?php echo $item['is']; ?></td>
                                            <td width="65" class="text-center"><?php echo $item['price']; ?></td>
                                            <td width="25" class="text-center"><?php echo $item['defData']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </table>
                        </form>
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

        <div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="addToCartLabel">
            <div class="modal-dialog modal-lg" role="document" style="width:90%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Добавление товара в корзину</h4>
                    </div>
                    <div class="modal-addToCart">

                    </div>
                    <div class="modal-footer">
                        <button id="btnAddToCart" type="button" onclick="addToCart();" class="btn btn-primary btn-sm" data-loading-text="Loading..."><i class="glyphicon glyphicon-shopping-cart"></i> В корзину</button>
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Закрыть</button>                        
                    </div>
                </div>
            </div>
        </div>   

        <script>

            $(document).on('click', '.btn_sel', function () {
                $('.modal-addToCart').load('http://opt.interkom.kz/ci/tovar/showFormCart', {code: $(this).data('code'), article: $(this).data('article'), mkei: $(this).data('mkei'), norm: $(this).data('norm'), idTovar: $(this).data('id'), tovarName: $(this).data('title'), priceTovar: $(this).data('price'), is: $(this).data('is')}, function (result) {
                    $('#addToCart').modal({show: true});
                    $('#addToCart').on('shown.bs.modal', function () {
                        $("#inp_cart", this).focus();
                        console.log('11', $("#inp_cart").val());
                    })
                });
            });

            function send_form()
            {
                var $btn = $('#btnSend').button('Проверка...');

                var dataSend = $('#formLogin').serialize();
                $.ajax({
                    type: 'POST',
                    url: '/ci/tovar/login',
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

            function addToCart()
            {
                var $btn = $('#btnAddToCart').button('Проверка...');
                var dataSend = $('#formAddToCart').serialize();
                $.ajax({
                    type: 'POST',
                    url: '/ci/tovar/addToCart',
                    data: dataSend,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 1) {
                            $('#ajax_result_cart').html('<div class="alert alert-success">' + data.message + '</div>');
                            $('#addToCart').modal('hide');
                        } else {
                            $('#ajax_result_cart').html('<div class="alert alert-danger">' + data.message + '</div>');
                            $btn.button('reset');
                        }
                    },
                    error: function ()
                    {
                        $('#ajax_result_cart').html('<div class="alert alert-danger">Ошибка выполнения запроса!</div>');
                        $btn.button('reset')
                    }
                });
            }

            function logout() {
                $.ajax({
                    type: 'POST',
                    url: '/ci/tovar/logout',
                    success: function (data) {
                        location.reload(true);
                    },
                    error: function ()
                    {
                        $('#ajax_result').html('<div class="alert alert-danger">Ошибка выполнения запроса!</div>');
                    }
                });
            }

            function search() {
                var dataSend = $('#searchForm').serialize();
                $.ajax({
                    type: 'POST',
                    url: '/ci/tovar/ajax_search',
                    data: dataSend,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 1) {
                            $('.col_insert').remove();
                            $(data.html).insertAfter('.col_insert_new:last');
                        } else {
                            $('#ajax_result').html('<div class="alert alert-danger">' + data.message + '</div>');
                        }
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
</head>