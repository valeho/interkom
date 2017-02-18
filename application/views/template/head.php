<?php header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <META HTTP-EQUIV="Content-language" content ="ru">
        <link href="<?php echo dir; ?>/css/style_new.css" media="all" rel="stylesheet" type="text/css">
        <link href="<?php echo dir; ?>/css/n.css" media="all" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/ci/bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="/ci/bootstrap/css/bootstrap-theme.min.css">

        <script src="/ci/js/jquery-1.11.3.min.js"></script>

        <script src="/ci/js/jquery-1.11.3.min.js"></script>
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

        <script>
            var processing = true;
            $(document).ready(function () {

                

                $(window).scroll(function () {
                    //if (!processing)
                    //return;
                    console.log($(window).scrollTop(), $(document).height(), $(window).height());
                    if ($(window).scrollTop() == $(document).height() - ($(window).height())) {
                        var dataSend = $('#searchForm').serialize();
                        var count = $('.col_insert').length;
                        $.ajax({
                            type: 'POST',
                            async: true,
                            cache: false,
                            url: '<?php echo dir; ?>/tovar/ajax_search',
                            data: dataSend + '&start=' + count,
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 1) {
                                    //processing = false;
                                    $(data.html).insertAfter('.col_insert:last');
                                }
                            },
                            error: function ()
                            {
                                $('#ajax_result').html('<div class="alert alert-danger">Ошибка выполнения запроса!</div>');
                            }
                        });
                    }

                    var h_hght = 0;
                    var h_mrg = 0;
                    var top = $(this).scrollTop();
                    var elem = $('#menu_vv');
                    if ((top + h_mrg) < h_hght) {
                        elem.css('top', (h_hght - top));
                    } else {
                        elem.css('top', h_mrg);
                        elem.css('width', '100%');
                        elem.css('height', '51px');
                    }


                    var h_hght1 = 0;
                    var h_mrg1 = 50;
                    var top1 = $(this).scrollTop();
                    var elem1 = $('.tb_1');
                    if ((top1 + h_mrg1) < 51) {
                        elem1.css('top', 90);
                    } else {
                        elem1.css('top', h_mrg1);
                        elem1.css('width', '100%');
                        elem1.css('height', '0px');
                    }
                    console.log(top1, h_mrg1, h_hght1);

                });
                var h_hght1 = 0;
                var h_mrg1 = 50;
                var top1 = $(this).scrollTop();
                var elem1 = $('.tb_1');
                if ((top1 + h_mrg1) < 51) {
                    elem1.css('top', 90);
                } else {
                    elem1.css('top', h_mrg1);
                    elem1.css('width', '100%');
                    elem1.css('height', '120px');
                }
            });
        </script>
        <link href="/test_web/css/style_new.css" media="all" rel="stylesheet" type="text/css">
    </head>

    <body>
    <?php if ($loginData['logged_in'] == FALSE) {

    redirect(dir.'/tovar');

}
?>