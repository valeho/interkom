<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admbanner extends MX_Controller
{
    private $_is_admin = false;
    private $_is_moder = false;

    private $_model_name    = 'my_model';
    private $_redirect      = "admbanner";

    private $_list_blank    = 'index';
    private $_add_blank     = "insert";
    private $_edit_blank    = "update";
    private $_del_blank     = "delete";

    private $_data = array(
        /*методы для ссылок*/
        'method_index'  => '/admbanner/index',
        'method_add'    => '/admbanner/add_data',
        'method_edit'   => '/admbanner/edit_data',
        'method_del'    => '/admbanner/del_data',

        /*названия кнопок*/
        'title_but_add'      => 'Добавить запись',

        /*название колонок таблицы/формы*/
        'title_field'             => 'Название',
        'menu_field'              => 'Пункт меню',
        'place_field'             => 'Место',
        'pic_field'               => 'Превью',

        /*заголовок формы добавления*/
        'form_title_add'    => 'Форма добавления записи',

        /*заголовок формы редактирования*/
        'form_title_edit'   => 'Форма редактирования записи',

        /*заголовок формы удаления*/
        'form_title_del'   => 'Форма удаления записи',

        /*системное сообщение о удалении*/
        'form_message_del'   => 'Вы действительно хотите удалить запись:',

        'link_hide'     => '/admbanner/hide',

        'title_menu'    => 'Контент сайта',

        'title_menu_sub' => 'Баннер',
    );

    private $_lng = 0;

    public function __construct()
    {
        parent::__construct();
        $this->autinit();
        $this->load->model($this->_model_name, '_model_m');
    }

    private function autinit()
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
        {
            $this->_is_admin = TRUE;
        }
        else
        {
            redirect('admin/login', 'refresh');
        }
    }

    public function index()
    {
        $this->_data['content'] = $this->_model_m->showRecords();
        $this->adm_templ->_render_page($this->_list_blank, $this->_data);
    }

    private function rules()
    {
        $this->form_validation->set_rules('photo', 'Название', 'required');
    }

    public function add_data()
    {
        $this->rules();

        if ($this->form_validation->run() == true)
        {
            $additional_data = $this->input->post(null, TRUE);

            $this->_model_m->insertRecords($additional_data);

            redirect($this->_redirect, 'refresh');
        }
        else
        {
            $this->_data['place'] = array(
                'name'  => 'place',
                'id'    => 'place',
                'type'  => 'text',
                'value' => $this->_model_m->maxPlace(),
                'class'  => 'form-control input-sm',
            );

            $js = 'javascript:history.back(-1);';
            $this->_data['but_back'] = array('name'=>'res_but', 'value'=>'true', 'content'=>'Назад','class'=>'btn btn-primary btn-sm', 'onClick'=>$js);

            $this->adm_templ->_render_page($this->_add_blank, $this->_data);
        }
    }

    public function edit_data($id=0)
    {
        $this->rules();

        if ($this->form_validation->run() == true)
        {
            $additional_data = $this->input->post();

            $additional_data['id'] = $id;

            $this->_model_m->updateRecords($additional_data);

            redirect($this->_redirect, 'refresh');
        }
        else
        {
            $result_n = $this->_model_m->showSinglRecord($id);

            $this->_data['place'] = array(
                'name'  => 'place',
                'id'    => 'place',
                'type'  => 'text',
                'value' => $result_n->place,
                'class'  => 'form-control input-sm',
            );

            $this->_data['photo'] = $result_n->pic;
            $this->_data['link'] = $result_n->link;

            $js = 'javascript:history.back(-1);';
            $this->_data['but_back'] = array('name'=>'res_but', 'value'=>'true', 'content'=>'Назад','class'=>'btn btn-primary btn-sm', 'onClick'=>$js);

            $this->adm_templ->_render_page($this->_edit_blank, $this->_data);
        }
    }

    public function del_data($id=0)
    {
        if (isset($_POST) && !empty($_POST))
        {
            $additional_data = array(
                'id'    => $id,
            );

            $this->_model_m->deleteSinglRecord($additional_data);
            redirect($this->_redirect, 'refresh');
        }
        else
        {
            $js = 'javascript:history.back(-1);';
            $this->_data['but_back'] = array('name'=>'res_but', 'value'=>'true', 'content'=>'Нет','class'=>'but_back', 'onClick'=>$js);

            $result = $this->_model_m->showSinglRecord($id);
            $this->_data['title'] = $result->pic;

            $this->adm_templ->_render_page($this->_del_blank, $this->_data);
        }
    }

    /******************************************************************************************************************/
    public function hide()
    {
        $id = $_REQUEST['id'];
        $this->_model_m->upd_active($id);
        $active = $this->_model_m->select_active($id);
        if($active->activity ==1)
        {
            echo json_encode(array('status'=>1));
        }
        else
        {
            echo json_encode(array('status'=>2));
        }
    }
    
    public function delete()
    {
        $id = (int) $this->input->post('id_record', TRUE);

        sys_banner::connection()->transaction();
        try
        {
            $result = sys_banner::find('first', array('conditions' => array('id = ?', (int) $id)));
            if (is_null($result))
            {
                $data['status'] = 2;
                $data['message'] = 'Удаляемая запись не найдена!';
            }
            else
            {

                if (!$result->delete())
                {
                    $data['status'] = 2;
                    $data['message'] = implode('<br>', $result->errors->full_messages());
                    sys_banner::connection()->rollback();
                }
                else
                {
                    $data['status'] = 1;
                    $data['message'] = 'Удаление прошло успешно';
                    sys_banner::connection()->commit();
                }
            }
        }
        catch (Exception $ex)
        {
            $data['status'] = 2;
            $data['message'] = $ex->getMessage();
            sys_banner::connection()->rollback();
        }

        echo json_encode($data);
    }
}
