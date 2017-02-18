<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adm_templ
{

    private $_name_user = null;
    private $_new_data = array();
    private $_data = array();
    public $_is_member = false;
    public $_is_admin = false;
    public $_is_adminmins = false;
    public $user_data = null;

    public function __construct()
    {
        $this->autinit();
        $user = $this->ion_auth->user()->row();
        @$this->_name_user = $user->company; // . ' ' . $user->first_name;
        $this->user_data = $user;
    }

    public function _render_page($new_templ = '', $data = array())
    {
        $this->_data['fio_user_adm'] = $this->_name_user;
        if ($this->_is_admin)
        {
            $this->_data['menu_str'] = $this->load->view("backend/default/_menu_admin_site", $this->_data, true);
        }
        elseif ($this->_is_member)
        {
            $this->_data['menu_str'] = $this->load->view("backend/default/_menu_member", $this->_data, true);
        }
        elseif ($this->_is_adminmins)
        {            
            $this->_data['menu_str'] = $this->load->view("backend/default/_menu_admin", $this->_data, true);
        }
        if (!empty($data))
        {
            $this->_new_data = array_merge($data, $this->_data);
        }
        else
        {
            $this->_new_data = $this->_data;
        }

        $tpl = $this->pages($new_templ, $this->_new_data);

        $this->load->view('backend/default/template', $tpl);
    }

    private function pages($tpl = '', $data = '')
    {
        $template['header'] = $this->load->view('backend/default/head', $data, TRUE);
        $template['menu'] = $this->load->view('backend/default/menu', '', TRUE);
        $template['content'] = $this->load->view($tpl, $data, TRUE);
        $template['footer'] = $this->load->view('backend/default/foot', '', TRUE);

        return $template;
    }

    public function __get($var)
    {
        return get_instance()->$var;
    }

    public function __set($key, $value)
    {
        if (property_exists($this, $key))
        {
            $this->$key = $value;
        }
    }

    public function autinit()
    {
        if ($this->ion_auth->logged_in())
        {
            if ($this->ion_auth->is_admin())
            {
                $this->_is_admin = TRUE;
            }
            elseif ($this->ion_auth->is_member())
            {
                $this->_is_member = TRUE;
            }
            elseif ($this->ion_auth->is_adminmins())
            {
                $this->_is_adminmins = TRUE;
            }
        }
    }

}
