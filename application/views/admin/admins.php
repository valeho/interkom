<?php $this->load->view('admin/template_head'); ?>
<?php $this->load->view('template/top_admin'); ?>
<div id="content2">
    <table class="table table-stripe colls fixed" id="content">
        <tr>
            <th width="40%">Логин</th>
            <th width="40%">Пароль</th>
            <th></th>
        </tr>
    </table>

    <?php
   // print_r($arr);
    if(!empty($arr)) {
        ?>    <table class="table table-stripe colls"><?php
        foreach($arr as $item) {

            ?>

            <tr>
                <td width="40%"><?php echo $item->login; ?></td>
                <td width="40%"><?php echo $item->password; ?></td>
                <td>111<a href="<?php echo dir; ?>/admin/get_edit_admin/<?php echo $item->id; ?>">Редактировать</a></td>
            </tr>
            <?php
        }
        ?>   </table><?php
    }
    ?>

</div>
</div>
<?php $this->load->view('admin/template_footer.php'); ?>
</body>
</html>