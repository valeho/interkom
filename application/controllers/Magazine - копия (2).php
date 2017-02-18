<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of magazine
 *
 * @author a.victor
 */
class Magazine extends CI_Controller
{

    private $_data = array();
    private $_binData;
    private $_skidCode = "''";

    public function __construct()
    {
        parent::__construct();

        $this->_binData = $this->session->userdata('dataLogin');
        if (!is_null($this->_binData))
        {
            $this->_skidCode = "'" . $this->_binData['binaryData'] . "'";
        }
    }

    public function index()
    {
        $skidki = $this->session->userdata('dataLogin');
        $data['loginData'] = $skidki;
        $guid = $this->_skidCode;
        $sql = <<<EOL
                exec dbo.sp_tab_jrn $guid
EOL;
        $result = $this->db->query($sql);
        $data['content'] = $result->result();
        $data['guid'] = str_replace("'","", $guid);

        $this->load->view('magazine/index', $data);
    }

    public function show($id)
    {
        $skidki = $this->session->userdata('dataLogin');
        $data['loginData'] = $skidki;
        $data['id'] = $id;
        $guid = $this->_skidCode;
        $sql = <<<EOL
                exec dbo.sp_tab_chklist '$id'
EOL;
        $result = $this->db->query($sql);
        $data['content'] = $result->result();

        $this->load->view('magazine/show', $data);
    }
}
