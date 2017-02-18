<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function index()
    {
        //$this->session->sess_destroy();
        $this->load->helper('url');
        $logged = $this->session->userdata('dataLogin');
        if (isset($logged['logged_in']) AND $logged['logged_in'] == TRUE)
        {
            $data['userName'] = $logged['user_name'];
            $data['binaryData'] = $logged['binaryData'];
            $this->load->view('welcome/isLogin', $data);
        }
        else
        {
            $this->load->view('welcome/loginForm');
        }
    }

    public function test1()
    {
        echo md5('qwe123');
        $DB2 = $this->load->database('testDb', TRUE, TRUE);
        $result = $DB2->get('dbo.sys_users');
        $data = $result->result();
        var_dump($data);
    }

    public function login()
    {
        $login = $this->input->post('login', TRUE);
        $passwd = md5($this->input->post('passwd', TRUE));

        $DB2 = $this->load->database('testDb', TRUE, TRUE);
        
        
        $master = $this->load->database('master', TRUE, TRUE);

        $result = $DB2->query("SELECT * FROM dbo.sys_login WHERE login='" . $login . "' AND passwd='" . $passwd . "'");
        if ($result->num_rows() == 1)
        {
            $data = $result->row();

            $resultUna = $master->query("DECLARE @partner_guid varchar(46);SET @partner_guid = dbo._ic_partner_ref('kolinichenko');select @partner_guid as skidka");
            if ($resultUna->num_rows() == 1)
            {
                $dataUna = $resultUna->row();
            }
            else
            {
                $dataUna = '';
            }

            $newdata = array('dataLogin' =>
                array(
                    'user_name' => $data->login,
                    'uniq_name' => $data->uname,
                    'logged_in' => TRUE,
                    'binaryData' => (!empty($dataUna)) ? $dataUna->skidka : '',
                )
            );

            $this->session->set_userdata($newdata);

            echo json_encode(array('status' => 1, 'message' => 'Вы успешно авторизовались', 'username' => $data->login, 'binaryData' => (!empty($dataUna)) ? $dataUna->skidka : ''));
        }
        else
        {
            echo json_encode(array('status' => 2, 'message' => 'Авторизация не успешна'));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
    }

}
