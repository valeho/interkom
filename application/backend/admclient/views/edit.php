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
        height: 400,
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
                <h3 class="page-header">Для оптовых клиентов</h3>
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
