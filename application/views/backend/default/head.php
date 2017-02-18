<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Панель управления</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="/bootstrap/3.3.5/sand/bootstrap.css">        

        <script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <script type="text/javascript">

            $(function () {
                $("#dt").datetimepicker({
                    showSecond: true,
                    timeFormat: 'hh:mm:ss',
                    timeOnlyTitle: 'Выберите время',
                    timeText: 'Время',
                    hourText: 'Часы',
                    minuteText: 'Минуты',
                    secondText: 'Секунды',
                    currentText: 'Сейчас',
                    closeText: 'Закрыть',
                    dateFormat: 'yy-mm-dd'
                });
            });

        </script>

        <script src="/js/ui/jquery-ui.custom.js"></script>
        <script src="/js/ui/i18n/jquery.ui.datepicker-ru.js"></script>
        <script src="/js/jquery-ui-timepicker-addon.js"></script>
        <link rel='stylesheet' type='text/css' media='all' href="/css/ui/flick/jquery.ui.all.css">

        <style type="text/css">
            .ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
            .ui-timepicker-div dl { text-align: left; }
            .ui-timepicker-div dl dt { float: left; clear:left; padding: 0 0 0 5px; }
            .ui-timepicker-div dl dd { margin: 0 10px 10px 45%; }
            .ui-timepicker-div td { font-size: 90%; }
            .ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

            .ui-timepicker-rtl{ direction: rtl; }
            .ui-timepicker-rtl dl { text-align: right; padding: 0 5px 0 0; }
            .ui-timepicker-rtl dl dt{ float: right; clear: right; }
            .ui-timepicker-rtl dl dd { margin: 0 45% 10px 10px; }
        </style>

        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>js/tinymce/plugins/moxiemanager/skins/lightgray/skin.min.css" />

    </head>

    <body>
        <div id="wrapper">
            <script src="<?= base_url() ?>js/tinymce/plugins/moxiemanager/js/moxman.loader.min.js"></script>