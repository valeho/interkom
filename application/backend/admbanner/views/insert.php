
<?php 

echo form_open_multipart(uri_string()); 

?>

<script src="<?= base_url(); ?>js/tinymce/tinymce.js"></script>
<script>
    tinymce.PluginManager.load('moxiemanager', '<?= base_url(); ?>js/tinymce/plugins/moxiemanager/plugin.min.js');
</script>

<script>
    tinymce.init({
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons textcolor,moxiemanager, youtube,paste"
        ],
        toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect | forecolor backcolor",
        toolbar2: "cut copy paste pastetext | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image youtube media help code | inserttime preview",
        menubar: false,
        toolbar_items_size: 'small',
        invalid_elements: "span",
        language: 'ru',
        selector: "#body",
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
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Баннеры</h3>
            </div>            
        </div>

        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <table class="table table-bordered">
                    <tr>
                        <td><b><?= $place_field ?>*</b></td><td><?php echo form_input($place); ?></td>
                    </tr>
                    <tr>
                        <td><b>Ссылка*</b></td><td><input type="text" name="link" value="<?= set_value('link') ?>" class="form-control input-sm"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="row">
                                <div class="col-lg-12"><b>Фото:</b>
                                    <div class="input-group">
                                        <input type="text" name="photo" class="form-control input-sm" id="photo">
                                        <span class="input-group-btn">
                                            <input type="button" href="javascript:;" onclick="moxman.browse({path: '/upl', view: 'files', fields: 'photo', extensions: 'jpg,gif,png', convert_urls: true, relative_urls: false, remove_script_host: true});" class="btn btn-sm btn-primary" value="Прикрепить фото">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-3"></div>
        </div>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <?= form_submit('sub_but', 'Сохранить', 'class="btn btn-sm btn-primary"') ?>
                <?= form_button($but_back) ?>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</div>

<? echo form_close(); ?>