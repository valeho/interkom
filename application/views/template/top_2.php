
    <div class="line_top">
        <div class="menu-top-block">
            <div class="menu_site">
                <ul>
                    <li>
                        <a href="<?php echo dir; ?>/tovar" class="btn-menu">Главная</a>
                    </li>

                    <?php
                    if (@$loginData['logged_in'] == TRUE) {
                        ?>
                        <li>
                            <a href="<?php echo dir; ?>/magazine/index">Журнал заявок</a>
                        </li>

                    <?php } ?>
                    <!--   <li>
                        <a href="<?php //echo '/a2dsrc/contact/index'
                    ?>">Контакты</a>
                    </li>-->
                </ul>
            </div>
        </div>
        <div class="autoriz-wrapper">
            <div class="autoriz-block">
                <div class="autoriz-logo"></div>
                <div class="autoriz">
                    <?php
                    if ($loginData['logged_in'] == TRUE) {
                        ?>


                        <div><a><b><?php echo $loginData['compname']; ?></b>  <a href='#' onclick="logout();
                                        return false;" class="link_logout">Выход</a></div>

                        </php
                        <div><a href="http://opt.interkom.kz<?php echo dir; ?>/tovar/lk">Профиль</a> |  <?php
                            if($loginData['balance']>0) echo 'Ваша задолженность <span style="background:#ff4a38; font-weight:bold; padding:3px;">'.$loginData['balance'].' тг</span>';
                            if($loginData['balance']<0) echo 'Ваша переплата: <span style="background:green"> '.abs($loginData['balance']).' тг</span>';
                            ?></div>
                        <script>
                            function logout() {
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo dir; ?>/tovar/logout',
                                    success: function (data) {
                                        location.reload(true);
                                    },
                                    error: function (xhr, str) {
                                        alert('Возникла ошибка: ' + xhr.responseCode);
                                    }
                                });
                            }
                        </script>
                    <?php

                    }
                    else
                    {
                    ?>
                        <div class="autoriz-title">Авторизация</div>
                        <div class="reg-b"><a href="#" data-toggle="modal" data-target="#autorizModal">Войти</a>
                            / <a href="#" style="font-size: 11px;">Регистрация</a></div>
                        <?php
                    }
                    ?>

                </div>
                <div class="basket">
                    <div class="pic_basket"><a href="<?php echo dir; ?>/tovar/cart"><img src="/a2dsrc/media/images/basket.png"/></a></div>
                    <?php
                    //print_r($this->session->userdata());
                    echo '<div class="text_basket"><span id="summcart">'.@$this->session->userdata('summcart').'</span> Тг</div>';
                    ?><a href="#" onclick="confrimCart()">Оформить заказ</a><br />

                </div>

            </div>
            </li>
            </ul>
        </div>
    </div>