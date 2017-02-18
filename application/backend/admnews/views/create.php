<script src="<?= base_url(); ?>js/tinymce/tinymce.js"></script>
<script>

    $(function () {
        $("#tabs").tabs();
    });
    tinymce.init({
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons textcolor,paste"
        ],
        toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect | forecolor backcolor",
        toolbar2: "cut copy paste pastetext | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media help code | inserttime preview | pagebreak",
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
            "emoticons textcolor,paste"
        ],
        toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect | forecolor backcolor",
        toolbar2: "cut copy paste pastetext | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media help code | inserttime preview | pagebreak",
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
                        <input type="text" name="dt" class="form-control input-sm" id="dt" value="<?= set_value('dt') ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Фото</strong></p>
                        <input type="file" name="file[0]" size="20" class="form-control input-sm"/><p></p>
                    </div>                    
                </div>
                <p></p>
                        <div class="row">
                            <div class="col-lg-11">
                                <p><strong>Название</strong></p>
                                <input type="text" name="name_ru" class="form-control input-sm" id="name_ru" value="<?= set_value('name_ru') ?>">
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-lg-11">
                                <p><strong>Анонс</strong></p>
                                <textarea name="descript_ru" id="descript_ru"><?= set_value('descript_ru') ?></textarea>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-lg-11">
                                <p><strong>Текст</strong></p>
                                <textarea name="full_descript_ru" id="full_descript_ru"><?= set_value('full_descript_ru') ?></textarea>
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
