<?php $this->load->view('admin/template_head'); ?>
<?php $this->load->view('template/top_admin'); ?>
    <div id="content2">
        <?php
        if(!empty($add_view)) {
            $this->load->view($add_view, array("login" => $login, "password" => $password, "id" => $id, "edit" => '1'));
        }
        ?>
                </div>
	</div>
    <?php $this->load->view('admin/template_footer.php'); ?>
</body>
</html>