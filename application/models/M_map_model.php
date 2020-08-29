<?php

class M_map_model extends CI_Model
{
    function get($where = array())
    {
        $where['flag <>'] = 99;
        return $this->db->get_where("m_map", $where);
    }

    function get_all()
    {
        return $this->db->get_where("m_map", array("flag <>" => 99));
    }

    function insert($data)
    {
        $this->db->insert("m_map", $data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_map", $data);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_map", array("flag" => 99));
    }
}
