<?php $this->load->view('admin/template_head'); ?>
<?php $this->load->view('template/top_admin'); ?>

<div id="content2">
    <table class="table">
        <tr>
            <td width="200px">Заголовок</td>
            <td><?php echo $arr->title; ?></td>
        </tr>
        <tr>
            <td width="200px">Время</td>
            <td width="200px"><?php echo $arr->time; ?></td>
        </tr>
		<tr>
			<td width="200px">Текст сообщения</td>
			<td width><?php echo $arr->text; ?></td>
		</tr>
        <tr style="background:blue; color:#fff; text-align:center;"><td colspan="2">Просмотрели новость</td></tr>
        <tr><td colspan="2"><ul>
        <?php foreach ($who as $item) { ?>

                <li><?php echo $item->login; ?></li>


<?php
}
?>   </ul> </td></tr>
    </table>
</div>
<?php $this->load->view('admin/template_footer.php'); ?>
</body>
</html>
