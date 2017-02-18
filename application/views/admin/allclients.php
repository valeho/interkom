<?php $this->load->view('admin/template_head'); ?>
<?php $this->load->view('template/top_admin'); ?>

    <table class="table table-stripe colls">
        <tr>
            <th>Логин</th>
            <th>Наименование</th>
            <th>Сумма в корзине</th>
            <th>Баланс</th>
        </tr>
        <?php
        //print_r($arr);
        foreach($arr as $item) {
            $sty = '';

            ?>

            <tr <?php echo @$sty; ?>>
                <td><?php echo $item->_login; ?></td>
                <td><?php echo $item->_Desc; ?></td>
                <td><?php echo $item->_cart; ?></td>
                <td><?php echo $item->_balance; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
<script>
    function search(e) {
        var dataSend = $('#searchForm').serialize();
        // var e = $(this).prev().attr("id");
        //alert(dump($(this), $(this).id));
        var f = $('input:radio:checked');
        $('input:radio').each(function (i, e) {
                //   alert($(this).attr("id"));
                $(this).next().css("border-top", "3px #ccc");
                $(e).next().css("height", "42px;");
                $(this).next().css("background-color", "#fcfcfc");
                $(this).next().css("padding-top", "15px");
                $(this).next().css("margin-top", "0px");
            }
        )
        //  alert($(e).next().attr("id"));
        $(f).next().css("margin-top", "0px");
        $(f).next().css("border-top", "3px solid #0072bb");
        $(f).next().css("background", "#ffffff");
        $(f).next().css("padding-top", "15px");
        $(e).next().css("height", "42px;");
        //e.style.background  = '#000';
    }
</script>
</body>
</html>