<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Пользователи</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">

                <div class="row">
                    <div class="col-lg-12 text-right">
                        <a href="<?php echo site_url(); ?>admusers/add_data" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> Добавить пользователя</a>
                    </div>
                </div>
                <p></p>

                <table class="table table-bordered">
                    <tr>
                        <th class="name" align="left"><?= $login_field ?></th>
                        <th class="name" align="left">Организация</th>
                        <th class="name" align="right"><?= $last_field ?></th>
                        <th class="name"></th>
                    </tr>
                    <?php
                    foreach ($content as $content_key => $content_val):
                        if ($content_val->active == 1)
                        {
                            $class = "";
                        }
                        else
                        {
                            $class = "active_off";
                        }
                        ?>
                        <tr valign="middle"><td align="left"><?= $content_val->username ?></td>
                            <td align="left"><?php echo $content_val->company ?></td>
                            <td align="right"><?php echo date('d-m-Y H:i:s', $content_val->last_login); ?></td>
                            <td align="center">
                                <?php echo anchor($method_edit . "/" . $content_val->id, '<i class="glyphicon glyphicon-pencil"></i>'); ?>&nbsp;&nbsp;&nbsp;
                                <a href="#" data-toggle="modal" data-target="#deleteModal" data-whatever="<?php echo $content_val->id; ?>"><i class="glyphicon glyphicon-trash"></i></a>                                    
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Удаление отчета</h4>
            </div>
            <div class="modal-body">
                <div id="ajax_result"></div>
                <form id="formData">
                    <div class="form-group text-center">
                        Вы действительно хотите удалить пользователя?
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
        $('#ajax_result').empty();
        modal.find('#id_record').val(recipient);
    })

    function deleteRecord()
    {
        var data = $('#formData').serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(); ?>admusers/del_user',
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