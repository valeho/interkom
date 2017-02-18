<div class="line_top" id="menu_vv">
    <div class="menu-top-block">
        <div class="menu_site">
            <ul>
                <li>
                    <a href="/opt/tovar" class="btn-menu">Главная</a>
                </li>
                <li>
                    <a href="<?php echo '/a2dsrc/company/index' ?>">О компании</a>
                </li>
                <li>
                    <a href="<?php echo '/opt/tovar/index' ?>">Для оптовых клиентов</a>
                </li>
                <li>
                    <a href="<?php echo '/a2dsrc/supplier/index' ?>">Поставщикам</a>             
                </li>
                <li>
                    <a href="<?php echo '/a2dsrc/news/index' ?>">Новости</a> 
                </li>
                <li>
                    <a href="<?php echo '/a2dsrc/contact/index' ?>">Контакты</a> 
                </li>
                <li>
                    <div class="autoriz-block">
                        <div class="autoriz-logo"></div>
                        <div class="autoriz">
                            <?php
                            if ($loginData['logged_in'] == TRUE)
                            {
                                ?>
                                <div class="loginO"><?php echo isset($loginData['compname']) ? $loginData['compname'] : ''; ?></div>
                                <div><a href='#' onclick="logout();return false;" class="link_logout">Выход</a></div>
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
<div class="top-block" style="margin-top: 32px;">
    <div class="logo-block">
        <a href="<?php echo '/a2dsrc/'; ?>"><div class="logo"></div></a>
    </div>
    <div class="other-block">
        <div class="skype-block">
            <div class="skype-logo"></div>
            <div class="skype-text">
                <div class="text-regul">Мы в Skype</div>
                <div class="text-medi">intercom.kz</div>
                <div class="top-link-sep"><a href="#" class="text-light">Онлайн консультация</a></div>
            </div>
        </div>
        <div class="phone-block">
            <div class="phone-logo"></div>
            <div class="phone-text">
                <div class="text-regul">Контактный телефон:</div>
                <div class="text-medi">+7 (7172) 31 87 87</div>
                <div class="top-link-sep"><a href="#" class="text-light">Заказать обратный звонок</a></div>
            </div>
        </div>
        <div class="map-block">
            <div class="map-logo"></div>
            <div class="map-text">
                <div class="text-regul">Выберете отделение:</div>
                <div class="text-medi office">Офис продаж</div>
                <div class="top-link-sep text-light">Астана, пр. Республики д. 2 <a href="#">(Карта)</a></div>
            </div>
        </div>
        <div class="clr"></div>
        <div class="search-block">
            <form>
                <input type="text" placeholder="Введите название товара" class="search-input">
            </form>
        </div>
    </div>
    <div class="clr"></div>
</div>