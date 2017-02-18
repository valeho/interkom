<nav class="navbar navbar-inverse" style="border-radius: 0;">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand"></div>
            <div class="navbar-text">Система внутреннего электронного документооборота ИС ГУ</div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <p class="navbar-text navbar-right"><?php echo $fio_user_adm; ?>&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url() . 'admin/logout'; ?>"><span class="glyphicon glyphicon-log-out"></span> Выход</a></p>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->    
</nav>
<nav class="navbar navbar-default">
    <div class="container-fluid">
      <?php echo $menu_str; ?>
  </div>
</nav>
