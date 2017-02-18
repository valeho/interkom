<html>
    <head>
        <title>Авторизация</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="/ci/bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="/ci/bootstrap/css/bootstrap-theme.min.css">

        <script src="/ci/js/jquery-1.11.3.min.js"></script>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div id="ajax_result"></div>
                    <div class="alert alert-success">
                        <?php echo $userName; ?>
                        <?php echo (!empty($binaryData)) ? ', ' . $binaryData : ''; ?>
                    </div>
                    <a href="<?php echo '/ci/welcome/logout'; ?>" class="btn btn-primary">Выход</a>
                </div>
            </div>
        </div>



        <!-- Latest compiled and minified JavaScript -->
        <script src="/ci/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
