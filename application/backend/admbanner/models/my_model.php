<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class My_model extends CI_Model
{

    private $_tb_name = "sys_banners";
    private $_order_f = 'place';
    private $_order_t = 'asc';
    private $_data = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function showRecords()
    {
        $this->db->order_by($this->_order_f, $this->_order_t);
        $query = $this->db->get_where($this->_tb_name);
        foreach ($query->result() as $row)
        {
            $this->_data[] = $row;
        }
        return $this->_data;
    }

    public function showSinglRecord($id = 0)
    {
        $query = $this->db->get_where($this->_tb_name, array('id' => $id));
        if ($query->num_rows() > 0)
        {
            return $query->row();
        }
        return false;
    }

    /*     * **************************************************************************************************************** */

    public function insertRecords($data = array())
    {
        if (is_array($data) && count($data) > 0)
        {
            $additional_data = array(
                'place' => $data['place'],
                'pic' => $data['photo'],
                'link' => $data['link']
            );

            $this->db->insert($this->_tb_name, $additional_data);
        }
    }

    public function updateRecords($data = array())
    {
        if ((is_array($data) && count($data) > 0))
        {
            $additional_data = array(
                'place' => $data['place'],
                'pic' => $data['photo'],
                'link' => $data['link']
            );

            $additional_data_id = array(
                'id' => $data['id'],
            );

            $this->db->update($this->_tb_name, $additional_data, $additional_data_id);
        }
    }

    public function deleteSinglRecord($data = array())
    {
        if ((is_array($data) && count($data) > 0))
        {
            $this->db->delete($this->_tb_name, $data);
        }
    }

    public function upd_active($id = '')
    {
        $this->db->select('activity');
        $query = $this->db->get_where($this->_tb_name, array('id' => $id));
        $row = $query->row();
        if ($row->activity == 1)
        {
            $this->db->update($this->_tb_name, array('activity' => 0), array('id' => $id));
        } else
        {
            $this->db->update($this->_tb_name, array('activity' => 1), array('id' => $id));
        }
    }

    public function select_active($id)
    {
        $this->db->select('activity');
        $query = $this->db->get_where($this->_tb_name, array('id' => $id));
        return $query->row();
    }

    public function maxPlace()
    {
        $this->db->select_max('place');
        $query = $this->db->get($this->_tb_name);
        $max = $query->row();
        return $max->place + 1;
    }

}
