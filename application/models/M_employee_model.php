<?php

class M_employee_model extends CI_Model
{
    function get($where)
    {
        return $this->db->get_where("m_employee", $where);
    }

    function get_all()
    {
        return $this->db->get_where("m_employee", array("flag <>" => 99));
    }

    function insert($data)
    {
        $this->db->insert("m_employee", $data);
        return $this->get($data);
    }

    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update("m_employee", $data);
        return $this->get($where);
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->update("m_employee", array("flag" => 99));
        return $this->get($where);
    }
}
