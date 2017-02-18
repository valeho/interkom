<div class="top_fixed">
    <div class="line_top">
        <div class="menu-top-block">
            <div class="admin_menu">
                <ul>
                    <li>
                        <!--<a href="../tovar" class="btn-menu">Главная</a>-->
                    </li>

                </ul>

            </div>
        </div>
        <div class="autoriz-wrapper">
            <div class="autoriz-block">
                <div class="autoriz-logo"></div>
                <div class="autoriz">



                        <div><a><b><?php echo @$loginData['adminLogin']; ?></b>  <a href='#' onclick="logout();
                                            return false;" class="link_logout">Выход</a></div>


                        <div><a href="http://opt.interkom.kz/test_web/tovar/lk">Профиль</a> | </div>
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
                </div>
            </div>
        </div>

    </div>
    <div class="bread_admin">
        <a href="<?php echo dir; ?>/tovar"><span class="arr_b">Главная</span></a>
        <span class="arr_b1">Панель администратора</span>
        <div class="clr"></div>
    </div>

        <div id="menu_vv2">
            <ul>
                <li><input type="radio" name="group" value="1" id="vaz" class="radio-inline"
                           style="color:#fff; display:none; " checked url="stat" onclick="search(this);"><label
                        for="vaz" style="border-top: solid 3px #0072bb; top:0px;">Статистика авторизаций</label></li>
                <li><input type="radio" name="group" value="1" class="radio-inline" id="all"  style="color:#fff; display:none; " url="all" onclick="search(this);">
                    <label for="all" style="margin-left:-4px; top:-2px; position: relative;">Все клиенты</label></li>
                <li><input type="radio" name="group" value="1" class="radio-inline" id="admin"  style="color:#fff; display:none; " url="admins" onclick="search(this);">
                    <label for="admin" style="margin-left:-4px; top:-2px; position: relative;">Администраторы</label></li>
                <li><input type="radio" name="group" value="1" class="radio-inline" id="add_admin"  style="color:#fff; display:none; " url="add_admin" onclick="search(this);">
                    <label for="add_admin" style="margin-left:-4px; top:-2px; position: relative;">Добавить администратора</label></li>
                <li><input type="radio" name="group" value="1" class="radio-inline" id="news"  style="color:#fff; display:none; " url="news" onclick="search(this);">
                    <label for="news" style="margin-left:-4px; top:-2px; position: relative;">Информация</label></li>
                <li><input type="radio" name="group" value="1" class="radio-inline" id="add_new"  style="color:#fff; display:none; " url="add_news" onclick="search(this);">
                    <label for="add_new" style="margin-left:-4px; top:-2px; position: relative;">Добавить информацию</label></li>
            </ul>

        </div>
</div>
