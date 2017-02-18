<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admusers extends MX_Controller
{

    private $_model_name = 'my_model';
    private $_redirect = "admusers";
    private $_list_blank = 'index';
    private $_add_blank = "users/users_form";
    private $_edit_blank = "users/users_edit";
    private $_del_blank = "delete";
    private $_data = array(
        /* методы для ссылок */
        'method_add' => '/admusers/add_data',
        'method_edit' => '/admusers/edit_data',
        'method_del' => '/admusers/del_user',
        /* названия кнопок */
        'title_but_add' => 'Добавить запись',
        /* название колонок таблицы/формы */
        'login_field' => 'Логин',
        'fio_field' => 'ФИО',
        'last_field' => 'Последний вход',
        /* заголовок формы добавления */
        'form_title_add' => 'Форма добавления записи',
        /* заголовок формы редактирования */
        'form_title_edit' => 'Форма редактирования записи',
        /* заголовок формы удаления */
        'form_title_del' => 'Форма удаления записи',
        /* системное сообщение о удалении */
        'form_message_del' => 'Вы действительно хотите удалить запись:',
    );

    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('admin', 'refresh');
        }
        $this->load->model($this->_model_name, '_model_m');
    }

    public function index()
    {
        $this->_data['content'] = $this->_model_m->showRecords();
        $this->adm_templ->_render_page($this->_list_blank, $this->_data);
    }

    public function add_data()
    {
        //validate form input
//        $this->form_validation->set_rules('first_name', 'Имя', 'required');
//        $this->form_validation->set_rules('last_name', 'Фамилия', 'required');
        $this->form_validation->set_rules('company', 'Организация', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('username', 'Логин', 'required');
        $this->form_validation->set_rules('password', 'Пароль', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'Подтверждение пароля', 'required');

        $username = $this->input->post('username', TRUE);
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        $additional_data = array(
            'first_name' => $this->input->post('first_name', TRUE),
            'last_name' => $this->input->post('last_name', TRUE),
            'company' => $this->input->post('company', TRUE),
        );

        if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data, array($this->input->post('type_user'))))
        {
            //$this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("admusers", 'refresh');
        }
        else
        {
            //display the create user form
            //set the flash data error message if there is one
            $this->_data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->_data['first_name'] = array(
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_name'),
                'size' => '30',
                'class' => 'form-control input-sm'
            );
            $this->_data['last_name'] = array(
                'name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('last_name'),
                'size' => '30',
                'class' => 'form-control input-sm'
            );

            $this->_data['company'] = array(
                'name' => 'company',
                'id' => 'company',
                'type' => 'text',
                'value' => $this->form_validation->set_value('company'),
                'size' => '30',
                'class' => 'form-control input-sm'
            );

            $this->_data['username'] = array(
                'name' => 'username',
                'id' => 'username',
                'type' => 'text',
                'value' => $this->form_validation->set_value('username'),
                'size' => '30',
                'class' => 'form-control input-sm'
            );
            $this->_data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'value' => $this->form_validation->set_value('email'),
                'size' => '30',
                'class' => 'form-control input-sm'
            );
            $this->_data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password'),
                'size' => '30',
                'class' => 'form-control input-sm'
            );
            $this->_data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
                'size' => '30',
                'class' => 'form-control input-sm'
            );

            $d = array();
            foreach ($this->ion_auth->groups()->result() as $v)
            {
                $d[$v->id] = $v->description;
            }

            $this->_data['type_user'] = $d;

            $js = 'javascript:history.back(-1);';
            $this->_data['but_back'] = array('name' => 'res_but', 'value' => 'true', 'content' => 'Назад', 'class' => 'btn btn-primary', 'onClick' => $js);

            $this->adm_templ->_render_page($this->_add_blank, $this->_data);
        }
    }

//edit a user
    function edit_data($id = 0)
    {
        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        //validate form input
//        $this->form_validation->set_rules('first_name', 'Имя', 'required');
//        $this->form_validation->set_rules('last_name', 'Фамилия', 'required');
        $this->form_validation->set_rules('company', 'организация', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('username', 'Логин', 'required');

        if (isset($_POST) && !empty($_POST))
        {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
            {
                show_error('This form post did not pass our security checks.');
            }

            $data = array(
                'first_name' => $this->input->post('first_name', TRUE),
                'last_name' => $this->input->post('last_name', TRUE),
                'email' => $this->input->post('email', TRUE),
                'username' => $this->input->post('username', TRUE),
                'company' => $this->input->post('company', TRUE),
            );

            //Update the groups user belongs to
            $groupData = $this->input->post('type_user', TRUE);

            if (isset($groupData) && !empty($groupData))
            {

                $this->ion_auth->remove_from_group('', $id);
                $this->ion_auth->add_to_group($groupData, $id);
            }

            //update the password if it was posted
            if ($this->input->post('password'))
            {
                $this->form_validation->set_rules('password', 'Пароль', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', 'Подтверждение пароля', 'required');

                $data['password'] = $this->input->post('password');
            }

            if ($this->form_validation->run() === TRUE)
            {
                $this->ion_auth->update($user->id, $data);

                //check to see if we are creating the user
                //redirect them back to the admin page
                $this->session->set_flashdata('message', "Пользователь сохранен");
                redirect($this->_redirect, 'refresh');
            }
        }

        //display the edit user form
        $this->_data['csrf'] = $this->_get_csrf_nonce();

        //set the flash data error message if there is one
        $this->_data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        //pass the user to the view
        $this->_data['user'] = $user;
        $this->_data['groups'] = $groups;
        $this->_data['currentGroups'] = $currentGroups;

        $this->_data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
            'class' => 'form-control input-sm'
        );
        $this->_data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
            'class' => 'form-control input-sm'
        );

        $this->_data['company'] = array(
            'name' => 'company',
            'id' => 'company',
            'type' => 'text',
            'value' => $this->form_validation->set_value('company', $user->company),
            'size' => '30',
            'class' => 'form-control input-sm'
        );

        $this->_data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'text',
            'value' => $this->form_validation->set_value('email', $user->email),
            'class' => 'form-control input-sm'
        );

        $this->_data['username'] = array(
            'name' => 'username',
            'id' => 'username',
            'type' => 'text',
            'value' => $this->form_validation->set_value('username', $user->username),
            'class' => 'form-control input-sm'
        );

        $this->_data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'class' => 'form-control input-sm'
        );
        $this->_data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password',
            'class' => 'form-control input-sm'
        );

        $d = array();
        foreach ($this->ion_auth->groups()->result() as $v)
        {
            $d[$v->id] = $v->description;
        }

        $this->_data['type_user'] = $d;

        $js = 'javascript:history.back(-1);';
        $this->_data['but_back'] = array('name' => 'res_but', 'value' => 'true', 'content' => 'Назад', 'class' => 'btn btn-primary', 'onClick' => $js);

        $this->adm_templ->_render_page($this->_edit_blank, $this->_data);
    }

    function del_user()
    {
        if (isset($_POST) && !empty($_POST))
        {
            /* if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
              {
              show_error('This form post did not pass our security checks.');
              } */
            if ($this->ion_auth->delete_user((int) $this->input->post('id_record', TRUE)))
            {
                $data['status'] = 1;
                $data['message'] = "Пользователь успешно удален";
            }
            else
            {
                $data['status'] = 2;
                $data['message'] = "Не возможно удалить пользователя";
            }
            echo json_encode($data);
        }
    }

    function look_user($id)
    {
        $this->mylib->_render_page('users/users_look', null);
    }

    function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

}
