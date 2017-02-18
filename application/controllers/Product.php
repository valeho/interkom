<?php

/**
 * Created by PhpStorm.
 * User: a.victor
 * Date: 26.05.2015
 * Time: 0:15
 */
class Product1 extends CI_Controller
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

    public function index($page = 0)
    {
        $this->load->helper('form');

        $skidki = $this->session->userdata('dataLogin');
        //var_dump($skidki);

        $this->load->view('product/index', array('loginData' => $skidki));
    }

    public function test($page = 1)
    {
        $pages = ($this->input->get('page')) ? $this->input->get('page') : 1;
        $query = $this->db->query("exec dbo.sp_tab_goods $pages, '','',''," . $this->_skidCode);
        //echo $this->db->last_query();
        $arr = array();
        if ($query->num_rows() > 0)
        {
            $numb = $query->result()[0]->_top_p;
            $arr['result'] = $numb;
            foreach ($query->result() as $row)
            {
                $arr['product'][] = array('title' => $row->_descr, 'price' => number_format($row->_price, 2, ',', ' '), 'article' => $row->_art, 'code' => $row->_code, 'mkei' => $row->_ed);
            }
            echo json_encode($arr);
        }
    }

    public function ajax_search()
    {
        $word = "'" . str_replace("*", "", $this->input->post('title', TRUE)) . "'";
        $numb = "'" . str_replace("*", "", $this->input->post('numb', TRUE)) . "'";
        $art = "'" . str_replace("*", "", $this->input->post('art', TRUE)) . "'";

        $query = $this->db->query("exec dbo.sp_tab_goods 1, $word, $numb, $art, $this->_skidCode");
        //echo $this->db->last_query();
        $arr = array();
        $id = array();
        $numb = $query->result()[0]->_top_p;
        foreach ($query->result() as $row)
        {
            $arr[] = array('title' => $row->_descr, 'price' => number_format($row->_price, 2, ',', ' '), 'article' => $row->_art, 'code' => $row->_code, 'mkei' => $row->_ed);
            //$id[] = $row->id;
        }

        if (!empty($arr))
        {
            echo json_encode(array('status' => 1, 'product' => $arr, 'result' => $numb));
        }
        else
        {
            echo json_encode(array('status' => 2));
        }
    }

    public function ajax_search1()
    {
        $word = "'" . str_replace("*", "", $this->input->post('title', TRUE)) . "'";
        $numb = "'" . str_replace("*", "", $this->input->post('numb', TRUE)) . "'";
        $art = "'" . str_replace("*", "", $this->input->post('art', TRUE)) . "'";

        $query = $this->db->query("exec dbo.sp_tab_goods 1, $word, $numb, $art, $this->_skidCode");
        //echo $this->db->last_query();
        $arr = array();
        $id = array();
        $numb = $query->result()[0]->_top_p;
        foreach ($query->result() as $row)
        {
            $arr[] = array('title' => $row->_descr, 'price' => number_format($row->_price, 2, ',', ' '), 'article' => $row->_art, 'code' => $row->_code, 'mkei' => $row->_ed);
            //$id[] = $row->id;
        }

        if (!empty($arr))
        {
            echo json_encode(array('status' => 1, 'product' => $arr, 'result' => $numb));
        }
        else
        {
            echo json_encode(array('status' => 2));
        }
    }

}
