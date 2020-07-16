<?php

class M_unit_model extends CI_Model
{
    function get($where)
    {
        $where['flag <>'] = 99;
        return $this->db->get_where("m_unit", $where);
    }

    function get_all()
    {
        return $this->db->get_where("m_unit", array("flag <>" => 99));
    }

    function insert($data)
    {
        $this->db->insert("m_unit", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_unit", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_unit", array("flag" => 99));
        return $this->get($where);
    }
}
