<?php $this->load->view('template/head'); ?>

    <?php $this->load->view('template/top_2'); ?>
    <div class="bread" style="position: relative; top:0px;">
        <a href="/test_web/tovar"><span class="arr_b">Главная</span></a>
        <span class="arr_b1">Профиль</span>
        <div class="clr"></div>
    </div>
    <style>

        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 6px;
        }

    </style>



            <div class="col-md-4">

            <div class="text-block-main" style="border: 0">
                <div class="lk">
                    <span class="head">Личный кабинет клиента</span>
                    <div>
                        <p>Наименование контрагента:</p>
                        <input type="text" disabled value="<?php echo $loginData['compname']; ?>" />

                    </div>
                    <?php foreach($tels as $item) {
                        if($item->_mobile!=='') {

                            ?>
                         <div>
                             <p>Контактное лицо контрагента</p>
                             <input type="text" disabled value="<?php echo $item->_desc; ?>" />
                         </div>    
                         <div>
                           <p>Должность</p>
                             <input type="text" disabled value="<?php echo $item->_post; ?>" />
                         </div>
                            <div>
                                <p>Номер телефона</p>
                                <input type="text" class="phone" disabled value="<?php echo $item->_mobile; ?>" />
                                </div>
                            <?php
                        }
                        if($item->_work!=='') {

                            ?>
                            <div>
                                <p>Контактное лицо контрагента</p>
                                <input type="text" disabled value="<?php echo $item->_desc; ?>" />
                            </div>
                            <div>
                                <p>Должность</p>
                                <input type="text" disabled value="<?php echo $item->_post; ?>" />
                            </div>
                            <div>
                                <p>Номер телефона</p>
                                <input type="text" class="phone" disabled value="<?php echo $item->_work; ?>" />
                            </div>
                            <?php
                        }

                    }
                   //print_r($loginData['adress']);

?>
                    <div>
                        <p>Адрес доставки товара:</p>

                        <input type="text" class="map" disabled value="<?php echo $loginData['adress']->_AdressDelivery; ?>" />
                    </div>
                    <div>
                        <p>Адрес электронной почты:</p>
                        <input type="text" class="map" disabled value="<?php echo $loginData['adress']->_AddresED; ?>" />
                    </div>
                </div>
            </div>


    </div>
<div class="col-md-6"><div class="akt"><a href="http://opt.interkom.kz/ci/magazine/act"><img src="/image/akt.png" /></a></div></div>
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
    </body>
</html>