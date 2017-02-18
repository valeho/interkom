<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Поставщикам</h3>
            </div>            
        </div>

        <div class="row">
            <div class="col-lg-12 text-right">
                <a href="<?php echo site_url(); ?>admsupplier/create" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> Добавить запись</a>
            </div>
        </div>
        <p></p>
        <div class="row">
            <div class="col-lg-12">
                <?php if (!empty($content)): ?>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th class="col-md-2">Дата создания</th>
                            <th class="col-md-4">Заголовок</th>
                            <th class="col-md-5">Анонс</th>
                            <th class="col-md-1">Действие</th>
                        </tr>
                        <?php foreach ($content as $itemContent): ?>
                            <tr>
                                <td><?php echo $itemContent->date_create->format('Y-m-d H:i:s'); ?></td>
                                <td><?php echo $itemContent->name_ru; ?></td>
                                <td><?php echo mb_substr($itemContent->descript_ru, 0, 200) . '...'; ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-sm"><li class="glyphicon glyphicon-cog"></li></button>
                                        <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" style="right: 0;left:-116px">
                                            <li><a href="<?php echo site_url(); ?>admsupplier/edit/<?php echo $itemContent->id; ?>">Редактировать</a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#deleteModal" data-whatever="<?php echo $itemContent->id; ?>">Удалить</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Удаление записи</h4>
            </div>
            <div class="modal-body">
                <div id="ajax_result"></div>
                <form id="formData">
                    <div class="form-group text-center">
                        Вы действительно хотите удалить запись?
                        <input type="hidden" name="id_record" value="" id="id_record">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="deleteRecord();
                        return false;">Удалить</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var recipient = button.data('whatever');
        var modal = $(this);
        modal.find('#id_record').val(recipient);
    })

    function deleteRecord()
    {
        var data = $('#formData').serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(); ?>admsupplier/delete',
            data: data,
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