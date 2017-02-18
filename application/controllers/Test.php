<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Test
 *
 * @author a.victor
 */
class Test extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function test()
    {
        $query = $this->db->query("exec dbo.sp_tab_goods 8, '', '', '', '5000F6A5-C056-0800-11E0-BE539C7AC2E0', 1");
        $arr = array();
        $id = array();
        var_dump($query->num_rows());
        if ($query->num_rows() > 0)
        {
            $numb_n = $query->result()[0]->_top_n;
            $numb_fn = $query->result()[0]->_top_n;
            foreach ($query->result() as $row)
            {
                $st = 0;
                if ($row->_incart)
                {
                    $st = 1;
                }
                if ($row->_inwork)
                {
                    $st = 1;
                }
                if ($row->_is == 0)
                {
                    $way = 'нет';
                }
                if ($row->_is == 1)
                {
                    $way = 'на складе';
                }
                if ($row->_is == 2)
                {
                    $way = '~';
                }
                $arr[] = array(
                    'incart' => $st,
                    'id' => $row->_id,
                    'title' => $row->_descr,
                    'price' => number_format($row->_price, 0, '', ''),
                    'article' => $row->_art,
                    'code' => $row->_code,
                    'mkei' => $row->_ed,
                    'norm' => $row->_pack,
                    'is' => $way,
                    'defData' => '<button class="btn_sel" type="button" '
                    . 'data-code="' . $row->_code . '" '
                    . 'data-article="' . $row->_art . '" '
                    . 'data-mkei="' . $row->_ed . '"'
                    . 'data-norm="' . $row->_pack . '"'
                    . 'data-id="' . $row->_id . '"'
                    . 'data-title="' . $row->_descr . '"'
                    . 'data-price="' . number_format($row->_price, 0, '', '') . '"'
                    . 'data-is="' . $row->_is . '"'
                    . '>+</button>'
                );
            }
            var_dump($arr);
            $html = $this->load->view('tovar/tov', array('arr' => $arr,), true);
        }
    }

}
