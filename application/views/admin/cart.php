<?php $this->load->view('admin/template_head'); ?>
<?php $this->load->view('template/top_admin'); ?>
<div id="content2">
    <table class="table table-stripe colls fixed" id="content">
        <tr>
            <th>Код</th>
            <th>Артикул</th>
            <th>Наименование</th>
            <th width="100" class="text-center">Ед. изм.</th>
            <th width="80" class="text-center">Норм. уп.</th>
            <th width="65" class="text-center">Кол-во</th>
            <th width="65" class="text-center">Цена</th>
            <th></th>
        </tr>
        </table>

        <?php
        if(!empty($arr['content'])) {
        ?>    <table class="table table-stripe colls"><?php
                foreach($arr['content'] as $item) {
                $sty = '';
                //if($item->result=='2') $sty = 'style="background:pink"';
                //print_r($item);
                ?>

                <tr>
                    <td><?php echo $item->_code; ?></td>
                    <td><?php echo $item->_art; ?></td>
                    <td><?php echo $item->_descr; ?></td>
                    <td><?php echo $item->_ed; ?></td>
                    <td><?php echo $item->_pack; ?></td>
                    <td><?php echo $item->_count; ?></td>

                    <td><?php echo $item->_price; ?></td>
                    <td><?php echo $item->_amount; ?></td>

                </tr>
                <?php
            }
        ?>   </table><?php
        } else {
            ?>
                <div class="alert">Пустая корзина</div>
            <?php
        }
        ?>

</div>
</div>
<?php $this->load->view('admin/template_footer.php'); ?>
</body>
</html>