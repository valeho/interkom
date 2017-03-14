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
    private $_guid;

    public function __construct()
    {
        parent::__construct();

        $this->_binData = $this->session->userdata('dataLogin');
        if (!is_null($this->_binData))
        {
            $this->_skidCode = "'" . $this->_binData['binaryData'] . "'";
            $this->_guid = $this->_binData['binaryData'];
        }
    }

    public function getCountNews() {
        $master = $this->load->database('master', TRUE, TRUE);
        $sql = <<<EOL
                exec dbo.NewsCount $this->_skidCode
EOL;
        $result = $master->query($sql);
        $res = $result->result();
        //print_r($res);
        return $res[0]->CountView;
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
        $data['guid'] = str_replace("'", "", $guid);
        $data['count'] = $this->getCountNews();
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
echo $sql;
        $result = $this->db->query($sql);
        $data['content'] = $result->result();
        $data['guid'] = $id;
        foreach ($result->result() as $item ) {
            $summ[] = @$item->_amount;
            $summ_exec[] = @$item->_amount_exec;
        }
        $data['summ'] = array_sum($summ);
        $data['summ_exec'] = array_sum($summ_exec);
        $this->load->view('magazine/show', $data);
    }

    public function act()
    {
     //print 'http://localhost/trn/hs/rep/sv/act?id='.$this->_guid;

        if ($curl = curl_init())
        {

            curl_setopt($curl, CURLOPT_URL, 'http://localhost/trn/hs/rep/sv/'.$this->_guid);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_USERPWD, "dotnet:fdVQu1i");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
            $out = curl_exec($curl);
            header('Cache-Control: public');
            header('Content-type: application/pdf');
            //header('Content-Disposition: attachment; filename="new.pdf"');
            header('Content-Length: '.strlen($out));
            echo $out;
            curl_close($curl);
        }
    }

}
