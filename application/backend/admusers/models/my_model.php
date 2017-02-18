<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_model extends CI_Model
{
    private $_tb_name = "users";

    public function __construct()
    {
        parent::__construct();
    }

    public function showRecords()
    {
        $query = $this->db->get($this->_tb_name);
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return array();
    }

    public function showSinglRecord($id=0)
    {
        $query = $this->db->get_where($this->_tb_name, array('id' => $id));
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        return false;
    }

    /*******************************************************************************************************************/

    public function insertRecords($data = array())
    {
        if(is_array($data) && count($data) > 0)
        {
            $this->db->insert($this->_tb_name, $data);
        }
    }

    public function updateRecords($data = array(), $data2 = array())
    {
        if((is_array($data) && count($data) > 0) && (is_array($data2) && count($data2) > 0))
        {
            $this->db->update($this->_tb_name, $data, $data2);
        }
    }

    public function deleteSinglRecord($data = array())
    {
        if((is_array($data) && count($data) > 0))
        {
            $this->db->delete($this->_tb_name, $data);
        }
    }

    public function upd_active($id='')
    {
        $this->db->select('active');
        $query = $this->db->get_where($this->_tb_name, array('id'=>$id));
        $row = $query->row();
        if($row->active == 1)
        {
            $this->db->update($this->_tb_name, array('active'=>0), array('id'=>$id));
        }
        else
        {
            $this->db->update($this->_tb_name, array('active'=>1), array('id'=>$id));
        }
    }

    public function select_active($id)
    {
        $this->db->select('active');
        $query = $this->db->get_where($this->_tb_name, array('id'=>$id));
        return $query->row();
    }
}
