<div class="line_top" id="menu_vv">
    <div class="menu-top-block" style="width: 100%;">
        <div class="menu_site">
            <ul>
                <li>
                    <a href="/opt/tovar" class="btn-menu">Главная</a>
                </li>
                <!--  <li>
                        <a href="<?php //echo '/a2dsrc/company/index' ?>">О компании</a>
                    </li>-->
                <!-- <li>
                       <a href="--><?php //echo '/opt/tovar/index' ?><!--">Для оптовых клиентов</a>
                    </li>-->
                <?php
                if ($loginData['logged_in'] == TRUE)
                {
                    ?>
                    <li>
                        <a href="http://opt.interkom.kz/opt/tovar/cart">Корзина</a>
                    </li>
                    <li>
                        <a href="http://opt.interkom.kz/opt/magazine/index">Журнал</a>
                    </li>

                <?php } ?>
                <!--   <li>
                        <a href="<?php //echo '/a2dsrc/contact/index' ?>">Контакты</a>
                    </li>-->
                <li>
                    <div class="autoriz-block">
                        <div class="autoriz-logo"></div>
                        <div class="autoriz">
                            <?php
                            if ($loginData['logged_in'] == TRUE)
                            {
                                ?>
                                <div class="loginO"><?php echo isset($loginData['compname']) ? $loginData['compname'] : ''; ?></div>
                                <div><a href='#' onclick="logout();
                                        return false;" class="link_logout">Выход</a></div>
                                <script>
                                    function logout() {
                                        $.ajax({
                                            type: 'POST',
                                            url: '/ci/tovar/logout',
                                            success: function (data) {
                                                location.reload(true);
                                            },
                                            error: function (xhr, str) {
                                                alert('Возникла ошибка: ' + xhr.responseCode);
                                            }
                                        });
                                    }
                                </script>
                                <a><b>Вы авторизованы как:</b>
                                    <?php
                                    echo $loginData['compname'];
                                    //var_dump($loginData);
                                    /*if ($curl = curl_init()) {
                                        curl_setopt($curl, CURLOPT_URL, 'http://localhost/trn/hs/rep/usr/' . $loginData['binaryData']);
                                        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                                        curl_setopt($curl, CURLOPT_USERPWD, "dotnet:fdVQu1i");
                                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                                        $out = curl_exec($curl);
                                        $res = json_decode($out);
                                        /*
                                        header('Cache-Control: public');
                                        //header('Content-Disposition: attachment; filename="new.pdf"');
                                        header('Content-Length: ' . strlen($out));
                                        curl_close($curl);*/
                                        /*echo $res->description;
                                    }*/
                                    ?>
                                </a>
                            <?php
                            }
                            else
                            {
                            ?>
                                <div class="autoriz-title">Авторизация</div>
                                <div class="reg-b"><a href="#" data-toggle="modal" data-target="#autorizModal">Войти</a> / <a href="#" style="font-size: 11px;">Регистрация</a></div>
                                <?php
                            }
                            ?>

                        </div>
                        <div class="clr"></div>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>
