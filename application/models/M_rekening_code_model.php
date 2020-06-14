<?php

class M_rekening_code_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("m_rekening_code", $where);
    }

    function get_all()
    {
        return $this->db->get_where("m_rekening_code", array("flag <>" => 99));
    }

    function insert($data)
    {
        $this->db->insert("m_rekening_code", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_rekening_code", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_rekening_code", array("flag" => 99));
        return $this->get($where);
    }
}
