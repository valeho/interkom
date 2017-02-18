<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 09.09.2016
 * Time: 20:42
 */
?>
<div class="wrapper_form_auth">

    <div class="form_auth">
        <div id="ajax_result"></div>
        <form id="loginform" action="#">
            <h1>Добро пожаловать</h1>
            <div id="ajax_result2"></div>
            <div class="form-text">
                <div class="input-text">


                    <p><input class="login" type="text" placeholder="Введите ваш логин" name="login" id="login"/></p>
                </div>
                <div class="input-text"><p><input class="login" type="password" placeholder="Введите пароль" id="password" name="passwd"/></p>
                </div>
            </div>
        </form>
        <button id="btn-login" type="submit" class="btn btn-success formlogin" onclick="send_form()">Вход в личный кабинет</button>

    </div>
</div>

