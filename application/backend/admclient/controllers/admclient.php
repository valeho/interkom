<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admservice
 *
 * @author Виктор
 */
class Admclient extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in() AND !$this->ion_auth->is_admin())
        {
            redirect('admin/login', 'refresh');
        }
    }

    public function index()
    {

        $result = sys_client::find('all', array('conditions' => array('is_delete = ?', 0)));

        $data['content'] = $result;

        $this->adm_templ->_render_page('index', $data);
    }

    public function create()
    {
        $data = array();

        if ($this->input->post("save", TRUE) == 'Y')
        {
            sys_contact::connection()->transaction();
            try
            {
                $sys_data = new sys_client();
                $sys_data->name_ru = $this->input->post("name_ru", TRUE);
                $sys_data->descript_ru = $this->input->post("descript_ru", TRUE);
                $sys_data->date_create = date('Y-m-d H:i:s');
                $sys_data->is_delete = 0;

                if (!$sys_data->save())
                {
                    $data['message'] = implode('<br>', $sys_data->errors->full_messages());
                    sys_client::connection()->rollback();
                }
                else
                {
                    sys_client::connection()->commit();
                    redirect(site_url() . 'admclient/index', 'refresh');
                }
            }
            catch (Exception $ex)
            {
                $data['message'] = $ex->getMessage();
                sys_client::connection()->rollback();
            }
        }
        else
        {
            $data['name_ru'] = array(
                'name' => 'name_ru',
                'id' => 'name_ru',
                'type' => 'textarea',
                'rows' => '1',
                'cols' => '100',
                'style' => 'font-size: 12px;color: ',
                'value' => set_value('name_ru'),
            );

            $data['descript_ru'] = array(
                'name' => 'descript_ru',
                'id' => 'descript_ru',
                'type' => 'textarea',
                'value' => set_value('descript_ru'),
            );

            $js = 'javascript:history.back(-1);';
            $data['but_back'] = array('name' => 'res_but', 'value' => 'true', 'content' => 'Назад', 'class' => 'but_back', 'onClick' => $js);
        }
        $this->adm_templ->_render_page('create', $data);
    }

    public function edit($id = 0)
    {
        $data = array();

        if ($this->input->post("save", TRUE) == 'Y')
        {
            $sys_data = sys_client::find('first', array('conditions' => array('id= ?', (int) $id)));
            if (is_null($sys_data))
            {
                redirect(site_url() . 'admclient/index', 'refresh');
            }

            sys_client::connection()->transaction();
            try
            {
                $sys_data->name_ru = $this->input->post("name_ru", TRUE);
                $sys_data->descript_ru = $this->input->post("descript_ru", TRUE);
                $sys_data->date_update = date('Y-m-d H:i:s');
                $sys_data->is_delete = 0;

                if (!$sys_data->save())
                {
                    $data['message'] = implode('<br>', $sys_data->errors->full_messages());
                    sys_client::connection()->rollback();
                }
                else
                {
                    sys_client::connection()->commit();
                    redirect(site_url() . 'admclient/index', 'refresh');
                }
            }
            catch (Exception $ex)
            {
                $data['message'] = $ex->getMessage();
                sys_client::connection()->rollback();
            }
        }

        $result = sys_client::find('first', array('conditions' => array('id= ?', (int) $id)));
        if (is_null($result))
        {
            redirect(site_url() . 'admclient/index', 'refresh');
        }
        
        $data['name_ru'] = $result->name_ru;
        $data['descript_ru'] = $result->descript_ru;

        $this->adm_templ->_render_page('edit', $data);
    }

    public function delete()
    {
        $id = (int) $this->input->post('id_record', TRUE);

        sys_client::connection()->transaction();
        try
        {
            $result = sys_client::find('first', array('conditions' => array('id = ?', (int) $id)));
            if (is_null($result))
            {
                $data['status'] = 2;
                $data['message'] = 'Удаляемая запись не найдена!';
            }
            else
            {
                $result->is_delete = 1;

                if (!$result->save())
                {
                    $data['status'] = 2;
                    $data['message'] = implode('<br>', $result->errors->full_messages());
                    sys_client::connection()->rollback();
                }
                else
                {
                    $data['status'] = 1;
                    $data['message'] = 'Удаление прошло успешно';
                    sys_client::connection()->commit();
                }
            }
        }
        catch (Exception $ex)
        {
            $data['status'] = 2;
            $data['message'] = $ex->getMessage();
            sys_client::connection()->rollback();
        }

        echo json_encode($data);
    }
}
