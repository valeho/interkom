<?php

class Admwelc extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();  
        if (!$this->ion_auth->logged_in())
        {
            redirect('admin/login', 'refresh');
        }
    }

    public function index()
    {
        $this->adm_templ->_render_page('index');
    }
}
