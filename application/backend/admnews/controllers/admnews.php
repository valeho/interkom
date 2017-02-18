<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admreport
 *
 * @author Виктор
 */
class Admnews extends MX_Controller {

    const UPL_DIR = './upl/news';

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/login', 'refresh');
        }
    }

    public function index() {

        $result = sys_data::find('all', array('conditions' => array('root_id = ? AND is_delete = ?', $this->adm_templ->user_data->user_id, 0)));

        $data['content'] = $result;

        $this->adm_templ->_render_page('index', $data);
    }

    public function upl() {
        $config['upload_path'] = self::UPL_DIR;
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '20536';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $temp_files = $_FILES;
        //var_dump($_FILES['file']['name']);
        $files_data = array();
        if (isset($_FILES['file'])) {
            $count = count($_FILES['file']['name']);
            
            for ($i = 0; $i <= $count + 1; $i++) {
                if (!empty($temp_files['file']['name'][$i])) {
                    $_FILES['file'] = array(
                        'name' => $temp_files['file']['name'][$i],
                        'type' => $temp_files['file']['type'][$i],
                        'tmp_name' => $temp_files['file']['tmp_name'][$i],
                        'error' => $temp_files['file']['error'][$i],
                        'size' => $temp_files['file']['size'][$i]);
                    $this->upload->do_upload('file');
                    $tmp_data = $this->upload->data();
                    $files_data[$i] = self::UPL_DIR . '/' . $tmp_data['file_name'];
                }
            }
        }
        return $files_data;
    }

    public function create() {
        $data = array();

        if ($this->input->post("save", TRUE) == 'Y') {
            sys_data::connection()->transaction();
            try {
                $sys_data = new sys_data();
                $sys_data->root_id = $this->adm_templ->user_data->user_id;
                $sys_data->name_ru = $this->input->post("name_ru", TRUE);
                $sys_data->descript_ru = $this->input->post("descript_ru", TRUE);
                $sys_data->full_descript_ru = $this->input->post("full_descript_ru", TRUE);
                $sys_data->date_create = date('Y-m-d H:i:s');
                $sys_data->date_record = $this->input->post("dt", TRUE);
                $pic = array_unique($this->upl());
                $sys_data->pic1 = (isset($pic[0])) ? $pic[0] : '';
                $sys_data->is_delete = 0;

                if (!$sys_data->save()) {
                    $data['message'] = implode('<br>', $sys_data->errors->full_messages());
                    sys_data::connection()->rollback();
                } else {
                    sys_data::connection()->commit();
                    redirect(site_url() . 'admnews/index', 'refresh');
                }
            } catch (Exception $ex) {
                $data['message'] = $ex->getMessage();
                sys_data::connection()->rollback();
            }
        } else {
            $data['show_title'] = array('1' => 'Да', '0' => 'Нет');
            $data['show_descript'] = array('1' => 'Да', '0' => 'Нет');
            $data['show_full_descript'] = array('1' => 'Да', '0' => 'Нет');
            $data['date_show'] = array('1' => 'Да', '0' => 'Нет');
            $data['show_comment'] = array('0' => 'Нет', '1' => 'Да');

            $data['name_ru'] = array(
                'name' => 'name_ru',
                'id' => 'name_ru',
                'type' => 'textarea',
                'rows' => '1',
                'cols' => '100',
                'style' => 'font-size: 12px;color: ',
                'value' => set_value('name_ru'),
            );

            $data['name_kz'] = array(
                'name' => 'name_kz',
                'id' => 'name_kz',
                'type' => 'textarea',
                'rows' => '1',
                'cols' => '100',
                'style' => 'font-size: 12px;color: ',
                'value' => set_value('name_kz'),
            );

            $data['descript_ru'] = array(
                'name' => 'descript_ru',
                'id' => 'descript_ru',
                'type' => 'textarea',
                'value' => set_value('descript_ru'),
            );

            $data['full_descript_ru'] = array(
                'name' => 'full_descript_ru',
                'id' => 'full_descript_ru',
                'type' => 'textarea',
                'value' => set_value('full_descript_ru'),
            );

            $data['dt'] = array(
                'name' => 'dt',
                'id' => 'dt',
                'type' => 'text',
                'size' => '15',
                'value' => date("Y-m-d h:i:s"),
            );

            $js = 'javascript:history.back(-1);';
            $data['but_back'] = array('name' => 'res_but', 'value' => 'true', 'content' => 'Назад', 'class' => 'but_back', 'onClick' => $js);
        }
        $this->adm_templ->_render_page('create', $data);
    }

    public function edit($id = 0) {
        $data = array();

        if ($this->input->post("save", TRUE) == 'Y') {
            $sys_data = sys_data::find('first', array('conditions' => array('root_id = ? AND id= ?', $this->adm_templ->user_data->user_id, (int) $id)));
            if (is_null($sys_data)) {
                redirect(site_url() . 'admnews/index', 'refresh');
            }

            sys_data::connection()->transaction();
            try {
                $sys_data->root_id = $this->adm_templ->user_data->user_id;
                $sys_data->name_ru = $this->input->post("name_ru", TRUE);
                $sys_data->descript_ru = $this->input->post("descript_ru", TRUE);
                $sys_data->full_descript_ru = $this->input->post("full_descript_ru", TRUE);
                $sys_data->date_update = date('Y-m-d H:i:s');
                $sys_data->date_record = $this->input->post("dt", TRUE);
                $sys_data->is_delete = 0;

                $pic = array_unique($this->upl());
                if (isset($pic[0])) {
                    $sys_data->pic1 = $pic[0];
                }
                if (isset($pic[1])) {
                    $sys_data->pic2 = $pic[1];
                }
                if (isset($pic[2])) {
                    $sys_data->pic3 = $pic[2];
                }
                if (!$sys_data->save()) {
                    $data['message'] = implode('<br>', $sys_data->errors->full_messages());
                    sys_data::connection()->rollback();
                } else {
                    sys_data::connection()->commit();
                    redirect(site_url() . 'admnews/index', 'refresh');
                }
            } catch (Exception $ex) {
                $data['message'] = $ex->getMessage();
                sys_data::connection()->rollback();
            }
        }

        $result = sys_data::find('first', array('conditions' => array('root_id = ? AND id= ?', $this->adm_templ->user_data->user_id, (int) $id)));
        if (is_null($result)) {
            redirect(site_url() . 'admnews/index', 'refresh');
        }

        $data['show_title'] = array('1' => 'Да', '0' => 'Нет');
        $data['show_descript'] = array('1' => 'Да', '0' => 'Нет');
        $data['show_full_descript'] = array('1' => 'Да', '0' => 'Нет');
        $data['date_show'] = array('1' => 'Да', '0' => 'Нет');
        $data['show_comment'] = array('0' => 'Нет', '1' => 'Да');

        $data['name_ru'] = $result->name_ru;

        $data['descript_ru'] = $result->descript_ru;

        $data['full_descript_ru'] = $result->full_descript_ru;

        $data['dt'] = $result->date_record->format('Y-m-d H:i:s');

        $data['pic1'] = $result->pic1;
        $data['id'] = $result->id;

        $this->adm_templ->_render_page('edit', $data);
    }

    public function delete() {
        $id = (int) $this->input->post('id_record', TRUE);

        sys_data::connection()->transaction();
        try {
            $result = sys_data::find('first', array('conditions' => array('root_id = ? AND id = ?', $this->adm_templ->user_data->user_id, (int) $id)));
            if (is_null($result)) {
                $data['status'] = 2;
                $data['message'] = 'Удаляемая запись не найдена!';
            } else {
                $result->is_delete = 1;

                if (!$result->save()) {
                    $data['status'] = 2;
                    $data['message'] = implode('<br>', $result->errors->full_messages());
                    sys_data::connection()->rollback();
                } else {
                    $data['status'] = 1;
                    $data['message'] = 'Удаление прошло успешно';
                    sys_data::connection()->commit();
                }
            }
        } catch (Exception $ex) {
            $data['status'] = 2;
            $data['message'] = $ex->getMessage();
            sys_data::connection()->rollback();
        }

        echo json_encode($data);
    }

    public function delImage($id) {
        $id = (int) $id;
        $field = $this->input->post('field', TRUE);

        sys_data::connection()->transaction();
        try {
            $result = sys_data::find('first', array('conditions' => array('root_id = ? AND id = ?', $this->adm_templ->user_data->user_id, (int) $id)));
            if (is_null($result)) {
                $data['status'] = 2;
                $data['message'] = 'Удаляемая запись не найдена!';
            } else {
                $pic = $result->$field;
                $result->$field = '';

                if (!$result->save()) {
                    $data['status'] = 2;
                    $data['message'] = implode('<br>', $result->errors->full_messages());
                    sys_data::connection()->rollback();
                } else {
                    unlink($pic);
                    $data['status'] = 1;
                    $data['message'] = 'Удаление прошло успешно';
                    sys_data::connection()->commit();
                }
            }
        } catch (Exception $ex) {
            $data['status'] = 2;
            $data['message'] = $ex->getMessage();
            sys_data::connection()->rollback();
        }

        echo json_encode($data);
    }

}
