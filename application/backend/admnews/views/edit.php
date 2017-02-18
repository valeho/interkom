<script src="<?= base_url(); ?>js/tinymce/tinymce.js"></script>
<script>
    tinymce.PluginManager.load('moxiemanager', '<?= base_url(); ?>js/tinymce/plugins/moxiemanager/plugin.min.js');
    tinymce.PluginManager.load('youtube', '<?= base_url(); ?>js/tinymce/plugins/youtube/plugin.min.js');

    $(function () {
        $("#tabs").tabs();
    });

    tinymce.init({
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons textcolor,moxiemanager, youtube,paste"
        ],
        toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect | forecolor backcolor",
        toolbar2: "cut copy paste pastetext | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image youtube media help code | inserttime preview | pagebreak",
        menubar: false,
        pagebreak_separator: "<!-- my page break -- > ",
        toolbar_items_size: 'small',
        invalid_elements: "span",
        language: 'ru',
        selector: "#descript_ru",
        theme: "modern",
        height: 200,
        width: '100%',
        convert_urls: true,
        relative_urls: false,
        remove_script_host: true,
        forced_root_block: "",
        force_p_newlines: false
    });

    tinymce.init({
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons textcolor,moxiemanager, youtube,paste"
        ],
        toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect | forecolor backcolor",
        toolbar2: "cut copy paste pastetext | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image youtube media help code | inserttime preview | pagebreak",
        menubar: false,
        pagebreak_separator: "<!-- my page break -->",
        toolbar_items_size: 'small',
        invalid_elements: "span",
        language: 'ru',
        selector: "#full_descript_ru",
        theme: "modern",
        height: 350,
        width: '100%',
        convert_urls: true,
        relative_urls: false,
        remove_script_host: true,
        forced_root_block: "",
        force_p_newlines: false
    });

</script>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Новости</h3>
            </div>            
        </div>
        <?php echo form_open_multipart(uri_string()); ?> 
        <div class="row">
            <?php if (isset($message)): ?>
                <p></p>
                <div class="alert alert-danger"><?php echo $message; ?></div>
                <p></p>
            <?php endif; ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Дата</strong></p>
                        <input type="text" name="dt" class="form-control input-sm" id="dt" value="<?= $dt ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Фото</strong></p>
                        <div id='ajax_result'></div>
                        <?php if (!empty($pic1)) {
                            ?>
                            <img src="<?php echo substr($pic1, 1); ?>" border='0' width="100"><p><button onclick="delImg('pic1');
                                        return false;"><i class="glyphicon glyphicon-trash"></i></button></p>
                                                                                                     <?php
                                                                                                     } else {
                                                                                                         ?>
                            <input type="file" name="file[0]" size="20" class="form-control input-sm"/><p></p>
                        <?php } ?>


                    </div>                    
                </div>
                <p></p>
                <div class="row">
                    <div class="col-lg-11">
                        <p><strong>Название</strong></p>
                        <input type="text" name="name_ru" class="form-control input-sm" id="name_ru" value="<?= $name_ru ?>">
                    </div>
                </div>
                <p></p>
                <div class="row">
                    <div class="col-lg-11">
                        <p><strong>Анонс</strong></p>
                        <textarea name="descript_ru" id="descript_ru"><?= $descript_ru ?></textarea>
                    </div>
                </div>
                <p></p>
                <div class="row">
                    <div class="col-lg-11">
                        <p><strong>Текст</strong></p>
                        <textarea name="full_descript_ru" id="full_descript_ru"><?= $full_descript_ru ?></textarea>
                    </div>
                </div>

                <p></p>
                <div class="row">
                    <div class="col-lg-11">
                        <button type="submit" class="btn btn-primary" name="save" value="Y">Сохранить</button>
                    </div>
                </div>
                <p></p>
                <p></p>
            </div>            
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    function delImg(field) {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(); ?>admnews/delImage/<?php echo $id; ?>',
                        data: {field: field},
                        dataType: 'json',
                        success: function (data) {
                            if (data.status == 1)
                            {
                                location.reload(true);
                            }
                            else if (data.status == 2)
                            {
                                $('#ajax_result').html('<div class="alert alert-danger">' + data.message + '</div>');
                            }
                        },
                        error: function (xhr, str) {
                            $('#ajax_result').html('<div class="alert alert-danger">Ошибка выполнения запроса</div>');
                        }
                    });
                }
</script>